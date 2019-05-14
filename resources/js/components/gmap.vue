<template>
  <div ref="map" class="h-full w-full"></div>
</template>

<script>
export default {
  props: {
    izoom: {
      default: 12
    },
    coords: {
      required: true
    }
  },
  data: function() {
    return {
      map: null,
      zoom: this.izoom,
      center: {
        lat: 0,
        lng: 0
      },
      markers: []
    };
  },
  methods: {
    computeCoords: function() {
      const count = this.coords.length;
      const sum = this.coords.reduce(
        (sum, curr) => {
          return {
            lat: sum.lat + curr.lat,
            lng: sum.lng + curr.lng
          };
        },
        { lat: 0, lng: 0 }
      );

      this.center = {
        lat: sum.lat / count,
        lng: sum.lng / count
      };
    }
  },
  mounted: function() {
    this.computeCoords();

    window.Bus.$on("init-map", () => {
      this.map = new google.maps.Map(this.$refs.map, {
        center: this.center,
        zoom: this.zoom,
        styles: styles
      });

      this.markers = this.coords.map(i => {
        return new google.maps.Marker({
          position: i,
          icon: {
            url: "/img/" + i.icon + ".png",
            size: new google.maps.Size(64, 64),
            anchor: new google.maps.Point(32, 32)
          },
          map: this.map,
          url: i.url,
          title: i.title
        });
      });

      this.markers.forEach(marker => {
        google.maps.event.addListener(marker, "click", function() {
          window.open(this.url, "_blank");
        });
      });
    });
  }
};

const styles = [
  {
    featureType: "all",
    stylers: [
      {
        saturation: 0
      },
      {
        hue: "#e7ecf0"
      }
    ]
  },
  {
    featureType: "road",
    stylers: [
      {
        saturation: -70
      }
    ]
  },
  {
    featureType: "transit",
    stylers: [
      {
        visibility: "off"
      }
    ]
  },
  {
    featureType: "poi",
    stylers: [
      {
        visibility: "off"
      }
    ]
  },
  {
    featureType: "water",
    stylers: [
      {
        visibility: "simplified"
      },
      {
        saturation: -60
      }
    ]
  }
];
</script>
