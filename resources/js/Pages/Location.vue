<script setup>
import { useGeolocation } from '@/Composables/useGeolocation';
import AppLayout from '@/Layouts/AppLayout.vue';
import { computed, onMounted, ref, watch } from 'vue';
import { Loader } from '@googlemaps/js-api-loader';
import { useForm, usePage } from '@inertiajs/inertia-vue3';

  const { coords } = useGeolocation();
  const currPos = computed(() => ({
    lat: coords.value.latitude,
    lng: coords.value.longitude
  }));
  const loader = new Loader({ apiKey: import.meta.env.VITE_GOOGLE_MAP_APP_KEY });
  const mapDiv = ref(null);
  onMounted(async() => {
    window.Echo.channel('location')
      .listen('.App\\Events\\SendPosition', (e) => {
        console.log(e.location)
        coords.value.latitude = e.location.lat
        coords.value.longitude = e.location.long
      });
    if(currPos.value) {
      await loader.load()
    }
  })
  const initMap = () => {
    let marker = new google.maps.Marker;
    const map = new google.maps.Map(mapDiv.value, {
      center: currPos.value,
      zoom: 15
    })
    const toggleBounce = () => {
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }
    marker = new google.maps.Marker({
      map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: currPos.value,
    });
    marker.addListener("click", toggleBounce);
  }
  watch([coords], () => {
    initMap()
  });

  const dataForm = useForm(
    {
      lat: null,
      long: null
    }
  )

  // setInterval(() => {
  //   dataForm.lat = currPos.value.lat + 150
  //   dataForm.long = currPos.value.lng + 100
  //   dataForm.post(route('map.save'))
  // }, 20000);

</script>
<template>
  <AppLayout>
    <div>
      <p>Latitude: {{ currPos.lat.toFixed(2)}}</p>
      <p>Longitude: {{ currPos.lng.toFixed(2) }}</p>
      <div class="mt-10">
        <div ref="mapDiv" style="width:100%; height: 50vh;"></div>
      </div>
    </div>
  </AppLayout>
</template>