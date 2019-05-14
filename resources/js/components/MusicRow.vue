<template>
  <div class="flex items-center border-t">
    <div class="flex-1 flex flex-col sm:flex-row">
      <div class="flex-1 my-3 sm:mr-3">
        <input
          class="dd-input w-full"
          placeholder="Előadó"
          type="text"
          name="artist[]"
          v-model="artist"
          @input="changeArtist"
        >
        <div
          class="absolute bg-white border rounded z-10 w-full max-h-suggest overflow-scroll"
          v-if="artistList.length"
          v-on-clickaway="resetStuff"
        >
          <p
            class="font-bold p-1 hover:bg-pri-500 hover:text-white cursor-pointer"
            v-for="item in artistList"
            :key="item"
            @click="selectArtist(item)"
          >{{item}}</p>
        </div>
      </div>

      <div class="flex-1 my-3 sm:ml-3">
        <input
          class="dd-input w-full"
          placeholder="Szám"
          type="text"
          name="track[]"
          v-model="track"
          @input="changeTrack"
        >
        <div
          class="absolute bg-white border rounded z-10 w-full max-h-suggest overflow-scroll"
          v-if="trackList.length"
          v-on-clickaway="resetStuff"
        >
          <p
            class="font-bold p-1 hover:bg-pri-500 hover:text-white cursor-pointer"
            v-for="item in trackList"
            :key="item"
            @click="selectTrack(item)"
          >{{item}}</p>
        </div>
      </div>
    </div>
    <div class="w-10 my-2 ml-3 font-bold text-center">
      <div class="dd-button dd-button-outline-sec" @click="remove">X</div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import _ from "lodash";
import { mixin as clickaway } from "vue-clickaway";

export default {
  mixins: [clickaway],
  props: ["id"],
  data() {
    return {
      artist: "",
      selectedArtist: "",
      track: "",
      artistList: [],
      trackList: []
    };
  },
  computed: {
    selected: function() {
      return this.artist == this.selectedArtist;
    }
  },
  watch: {
    artist: function(artist) {
      this.$emit("change_artist", {
        id: this.id,
        artist: this.artist
      });
    },
    track: function(track) {
      this.$emit("change_track", {
        id: this.id,
        track: this.track
      });
    }
  },
  methods: {
    changeArtist: _.debounce(function(e) {
      if (!e.target.value) {
        this.artistList = [];
        return;
      }
      axios
        .get(
          "https://ws.audioscrobbler.com/2.0/?method=artist.search&artist=" +
            e.target.value +
            "&api_key=d8341a875e7b7fc1966e368de4e1e591&format=json"
        )
        .then(resp => {
          this.artistList = resp.data.results.artistmatches.artist
            .filter(a => a.listeners > 500)
            .map(a => a.name);
        })
        .catch(e => {
          this.artistList = [];
        });
    }, 500),
    selectArtist: function(a) {
      this.selectedArtist = this.artist = a;
      this.resetStuff();
    },
    changeTrack: _.debounce(function(e) {
      if (!e.target.value) {
        this.trackList = [];
        return;
      }
      axios
        .get(
          "https://ws.audioscrobbler.com/2.0/?method=track.search&artist=" +
            this.selectedArtist +
            "&track=" +
            e.target.value +
            "&api_key=d8341a875e7b7fc1966e368de4e1e591&format=json"
        )
        .then(resp => {
          this.trackList = resp.data.results.trackmatches.track
            .filter(t => t.listeners > 200)
            .map(t => t.name);
        })
        .catch(e => {
          this.trackList = [];
        });
    }, 500),
    selectTrack: function(t) {
      this.track = t;
      this.resetStuff();
    },
    resetStuff: function() {
      this.trackList = [];
      this.artistList = [];
      if (!this.selected) {
        this.selectedArtist = "";
      }
    },
    remove: function() {
      this.$emit("remove", this.id);
    }
  }
};
</script>