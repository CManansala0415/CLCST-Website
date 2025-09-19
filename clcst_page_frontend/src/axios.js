// import axios from "axios";

// axios.defaults.withCredentials = true;
// axios.defaults.baseURL = "https://9f43aba0c952.ngrok-free.app";

import axios from 'axios';

axios.defaults.baseURL = import.meta.env.VITE_API_URL;
axios.defaults.withCredentials = false;

// 👇 Add this line to skip the ngrok warning page
axios.defaults.headers.common['ngrok-skip-browser-warning'] = 'true';

export default axios;



