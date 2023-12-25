import Axios from "axios";
import cookie from "../plugins/cookie/authCookie";
const axios = Axios.create({
  baseURL: "http://localhost:8000/api",
  headers: {
    "Content-Type": "application/json",
    Accpet: "application/json",
  },
});
axios.interceptors.request.use(
  (config) => {
    const token = cookie.getCookieAuth();
    if (token) config.headers.Authorization = "Bearer " + token;
    return config;
  },
  function (error) {
    return Promise.reject(error);
  }
);
export default axios;
