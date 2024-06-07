import './bootstrap';
import { createApp } from 'vue';
import router from './router/index.js';

//v form



//toastr
import Toaster from "@meforma/vue-toaster";

//sweet alert
import Swal from 'sweetalert2'
window.Swal=Swal

 import MainComponent from './admin/Main.vue';
import FrontMain from './frontend/FrontMain.vue';
const app = createApp({
    components:{
        MainComponent
    }
});

app.component('front-main',FrontMain);


//pagination





app.use(Toaster,{
    position:'top-right',
});
app.use(router);
app.mount('#app');
