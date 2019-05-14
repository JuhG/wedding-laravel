<template>
  <div class="dd-container">
    <div class="dd-editor">
      <h2 class="dd-title">Zenekérés</h2>
      <p>Nem tudjuk garantálni, hogy mindent lejátszik a DJ, amit ide írsz, de határozottan segíteni fog.</p>
    </div>

    <form method="post" action @submit.prevent="onSubmit" ref="form" id="form">
      <input type="hidden" name="action" value="dd/music">
      <input type="hidden" name="csrf_name" value="csrf_value">

      <div class="my-3 flex flex-col sm:flex-row md:items-center">
        <div class="flex-1 my-3 sm:mr-3">
          <input class="dd-input w-full" type="text" placeholder="Neved" name="name" v-model="name">
        </div>
        <div class="my-3 sm:ml-3 flex justify-end">
          <a
            @click.prevent="addRow"
            class="dd-button dd-button-outline-sec w-48 text-center font-bold"
          >Több szám</a>
        </div>
      </div>

      <div v-for="item in list" :key="item.id">
        <music-row
          :id="item.id"
          @remove="removeRow"
          @change_artist="changeArtist"
          @change_track="changeTrack"
        ></music-row>
      </div>

      <p class="dd-title my-4" v-if="thanks">Köszi!</p>

      <div class="my-3">
        <input type="submit" value="Mentés" class="dd-button dd-button-sec">
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import _ from "lodash";

export default {
  props: ["csrf_name", "csrf_value"],
  data() {
    return {
      name: "",
      list: [],
      thanks: false
    };
  },
  mounted: function() {
    this.addEmptyRow();
  },
  methods: {
    addEmptyRow: function() {
      this.list.push({
        id: new Date().getTime(),
        artist: "",
        track: ""
      });
    },
    addRow: function() {
      this.addEmptyRow();
    },
    removeRow: function(id) {
      this.list = this.list.filter(item => {
        return item.id !== id;
      });
    },
    changeArtist: function(data) {
      this.list = this.list.map(item => {
        if (item.id === data.id) {
          item.artist = data.artist;
        }

        return item;
      });
    },
    changeTrack: function(data) {
      this.list = this.list.map(item => {
        if (item.id === data.id) {
          item.track = data.track;
        }

        return item;
      });
    },
    onSubmit: function() {
      const result = this.list.filter(item => {
        return item.artist || item.track;
      });

      if (!result.length) return;

      const data = {
        name: this.name,
        list: result
      };

      axios.post("/music", data).then(resp => {
        if (resp.data.response === "success") {
          this.thanks = true;
          this.list = [];
          setTimeout(() => {
            this.thanks = false;
            this.addEmptyRow();
          }, 3000);
        }
      });
    }
  }
};
</script>
