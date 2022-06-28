<style>
    .search-card{
        max-width: 500px;
        margin: auto;
    }
</style>
<template>
    <div style="margin-top: -17px;">
        <div class="bg-img-home" style="height: 250px;">
            <div style="padding-top: 70px;">
                <div class="mb-5 search-card">
                    <h2 class="text-center mb-3 fw-bold text-white">SEARCH FIELD</h2>
                    <input class="form-control" type="text" placeholder="Type field name or address" v-model="search" @input="searchField()">
                </div>
            </div>
        </div> 
        <div class="topic bg-main-green text-white mb-4">
            <div class="container text-center fs-2 fw-bold fst-italic pb-2">Nearby Field</div>
        </div>
        <div class="container">
            <div v-for="item in fields" class="card shadow-lg p-3 mb-3">
                <div class="d-flex">
                    <!-- <img style="max-width: 250px;" :src="'../storage/img/'+item.image" alt=""> -->
                    <!-- <img style="max-width: 250px;" :src="'/uploads/img/'+item.image" alt=""> -->
                    <img style="max-width: 250px;" :src="item.temporyUrl" alt="">
                    <div class="ps-3 w-100">
                        <span class="fw-bolder fs-3">{{ item.name }}</span>
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <span>{{ item.address }}</span>
                        </div>
                        <div>
                            <span>Jarak : {{ item.distance }} Km</span>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" @click="chooseField(item.id)" class="btn btn-outline-success">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'

export default{
    data() {
        return {
            fields_data: [],
            fields: [],
            currentPosition: {
                lat: 0,
                lng: 0,
            },
            data: {
                "id" : null
            },
            search: '',
            
        }
    },
    methods: {
        getFields() {
            axios.get('/api/fields').then((response) => {
                this.fields = response.data.data
                this.fields.forEach(item => {
                    item.distance = this.getDistanceFromLatLonInKm(this.currentPosition.lat, this.currentPosition.lng, item.lat, item.lng).toFixed(2)
                });
                this.fields = this.fields.sort((a, b) => {
                    return a.distance - b.distance;
                });
                this.fields_data = this.fields
            })
            // console.log(this.getDistanceFromLatLonInKm(59.3293371,13.4877472,59.3225525,13.4619422));
        },
        searchField(){
            var text = this.search
            if(this.search == ''){
                this.fields = this.fields_data;
            }else{
                // this.fields = this.fields.filter(item => item.name == this.search || item.address.includes(this.search));
                this.fields = this.fields.filter(function (e) {
                    return e.name.toLowerCase().includes(text) || e.address.toLowerCase().includes(text)
                })
            }
            console.log("this.fields ", this.fields);

        },
        chooseField(id){
            this.data.id = id
            window.location = '/fieldsTo/' + id
            // this.sendId();
        },
        sendId(){
            axios.post('/api/fieldsTo', this.data)
            .then((response) => {
                console.log(response);
            });
        },
        getLocation(){
            navigator.geolocation.getCurrentPosition(
                position => {
                    this.currentPosition.lat = position.coords.latitude;
                    this.currentPosition.lng = position.coords.longitude;
                    console.log("this.currentPosition ", this.currentPosition)
                    this.getFields();
                },
                error => {
                    console.log("error Location = ", error.message);
                }
            )
            
        },
        getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
            var R = 6371; // Radius of the earth in km
            var dLat = this.deg2rad(lat2-lat1);  // deg2rad below
            var dLon = this.deg2rad(lon2-lon1); 
            var a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2)
            ; 
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            var d = R * c; // Distance in km
            return d;
        },
        deg2rad(deg) {
            return deg * (Math.PI/180)
        },
    },
    created () {
        this.getLocation();
    },
}
</script>