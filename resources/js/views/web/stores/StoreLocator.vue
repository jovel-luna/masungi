<template>
	<div>
		<!-- Map -->
		<div class="rows xl-padding-tb">
			<div class="map">
				<GmapMap ref="mapRefs"
					:center="{
						lat: parseFloat(14.6093317), 
						lng: parseFloat(121.3133914),
					}"
					:zoom="15"
					map-type-id="roadmap"
					:options="mapOptions"
					style="height: 65vh;"
				>

					<GmapMarker :ref="'myMarker'" :width="'20px'"
						@click="infoWinOpen=true, infoWinOpen2=false, infoWinOpen3=false"
					    :position="google && new google.maps.LatLng(14.604823, 121.319176)"
					    :icon="{ url: '../images/images/MainPin.png'}" >
					</GmapMarker>
					<GmapMarker :ref="'myMarker'" :width="'20px'"
						@click="infoWinOpen2=true, infoWinOpen=false, infoWinOpen3=false"
					    :position="google && new google.maps.LatLng(14.612459, 121.311729)"
					    :icon="{ url: '../images/images/KM46Pin.png'}" >

					</GmapMarker>
					<GmapMarker :ref="'myMarker'" :width="'20px'"
						@click="infoWinOpen3=true, infoWinOpen2=false, infoWinOpen=false"
					    :position="google && new google.maps.LatLng(14.608997, 121.308395)"
						:icon="{ url: '../images/images/KM45Pin.png'}">
 					</GmapMarker>
					
					<gmap-info-window
						:options="infoOptions"
						:position="infoWindowPos"
						:opened="infoWinOpen"
						@closeclick="infoWinOpen=false"
					>
					<div v-html="infoContent"></div>
					</gmap-info-window>

					<gmap-info-window
						:options="infoOptions"
						:position="infoWindowPos2"
						:opened="infoWinOpen2"
						@closeclick="infoWinOpen2=false"
					>
					<div v-html="infoContent2"></div>
					</gmap-info-window>

					<gmap-info-window
						:options="infoOptions"
						:position="infoWindowPos3"
						:opened="infoWinOpen3"
						@closeclick="infoWinOpen3=false"
					>
					<div v-html="infoContent3"></div>
					</gmap-info-window>

				</GmapMap>
			</div>
		</div>
	</div>		
</template>
<script>

import {gmapApi, VueGoogleMaps} from 'vue2-google-maps';

export default {

	props: {
		fetchUrl: {
			type: String,
			default: null
		},

		iconPath: {
			type: String,
			default: null
		},
	},

	computed: {

		google: gmapApi,

	   	/**
	   	 * Render icon for marker
	   	 * 
	   	 */
	   	renderIcon: function() {
			return {
				url: this.iconPath,
			    size: {width: 33, height: 33, f: 'px', b: 'px'},
			    scaledSize: {width: 33, height: 33, f: 'px', b: 'px'}					
			};
	   	},

	},

	data: function() {
		return {
			search: null,
			selectedStore: {},

			mapOptions: {
			   zoomControl: false,
			   mapTypeControl: false,
			   scaleControl: true,
			   streetViewControl: false,
			   rotateControl: false,
			   fullscreenControl: false,
			   disableDefaultUi: false,
			   styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"color":"#d8d8d8"},{"lightness":55},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"},{"color":"#c3dbf4"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c3dbf4"}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"color":"#c3dbf4"},{"saturation":-100}]}]
			},

			infoContent: '<p> <i class="fas fa-map-marker-alt"></i> Kilometer 47 Marcos Highway, <p>Baras, Rizal, Philippines,<p> 1970, Marcos Highway, <p>Baras, 1970 Rizal <p><i class="fas fa-phone"> 0995 186 9911 </i> <p v-html="text"><a href="https://www.google.com/maps/place/Masungi+Georeserve/@14.6045684,121.3169717,17z/data=!3m1!4b1!4m5!3m4!1s0x33979457fe4d85ab:0xf0304d8f00c74db9!8m2!3d14.6045632!4d121.3191657" target="_blank"> Click here for Google Maps Direction </a> </p>'

,
// 14.601750, 121.320139
			infoWindowPos: { 
				lat: 14.604050,
				lng: 121.318839,
			},
// 14.599957, 121.312803
// 
			infoContent2: '<p> <i class="fas fa-map-marker-alt"></i>Kilometer 46 Cuyambay, Tanay, Rizal <p><i class="fas fa-phone"> 0995 186 9911 </i> <p v-html="text"><a href="' + "https://www.google.com/maps/place/14%C2%B035'59.9%22N+121%C2%B018'46.1%22E/@14.5999622,121.310609,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x0!8m2!3d14.599957!4d121.312803" + '" target="_blank"> Click here for Google Maps Direction </a> </p>'

,

			infoWindowPos2: { 
				lat: 14.601957,
				lng: 121.311500,
			},

// 14.604025, 121.327273

			infoContent3: '<p><i class="fas fa-map-marker-alt"></i>Kilometer 48 Cuyambay, Tanay, Rizal  <p><i class="fas fa-phone"> 0995 186 9911 </i> <p v-html="text"><a href="' + "https://www.google.com/maps/place/14%C2%B035'59.9%22N+121%C2%B018'46.1%22E/@14.5999622,121.310609,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x0!8m2!3d14.599957!4d121.312803" + '" target="_blank"> Click here for Google Maps Direction </a> </p>'
,

			infoWindowPos3: { 
				lat: 14.606025,
				lng: 121.327273,
			},


			infoWinOpen: false,
			infoWinOpen2: false,
			infoWinOpen3: false,
			currentMidx: null,
			//optional: offset infowindow so it visually sits nicely on top of our marker
			infoOptions: {
				pixelOffset: {
					width: 0,
					height: -35
				}
			},


		}
	},

	mounted: function() {
		this.init();
	},
 
	methods: {

	    /*
	    |--------------------------------------------------------------------------
	    | @Initialize
	    |--------------------------------------------------------------------------
	    */	
	   
	   openWindows: function() {
		console.log(marker);
	   	this.infoWindowPos = {
		  		lat: parseFloat(marker.latitude), 
		  		lng: parseFloat(marker.longitude)
		  	};



		//check if its the same marker that was selected if yes toggle
		if (this.currentMidx == idx) {
			this.infoWinOpen = !this.infoWinOpen;
		} else {
			this.infoWinOpen = true;
			this.currentMidx = idx;
		}		 

	   },

		
		init: function() {	
			// this.fetchStores();
		},


	},

}

</script>
