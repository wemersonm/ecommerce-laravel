import cookie from "../plugins/cookie/authCookie.js";
import axios from "../plugins/Axios.js";

const getDataUserAuth = async (authStore) => {
  try {
    const token = cookie.getCookieAuth();
    if (!token) {
      return false;
    }
    const { data } = await axios.get("/v1/me");
    updateSession(data, authStore);
    return true;
  } catch (error) {
    throw error;
  }
};

const makeLogin = async (payload, authStore) => {
  try {
    const { data } = await axios.post("/v1/login", payload);
    return updateSession(data, authStore);
  } catch (error) {
    throw error;
  }
};
const makeLogout = async () => {
  try {
    await axios.post("/v1/logout");
  } catch (error) {
  } finally {
    cookie.removeCookieAuthAll();
    window.location.href = "/";
  }
};

const makeRegisterAndLogin = async (payload, authStore) => {
  try {
    const { data } = await axios.post("/v1/register", payload);
    updateSession(data, authStore);
  } catch (error) {
    throw error;
  }
};

const forgotPassword = async (payload) => {
  try {
    await axios.post("/v1/forgot-password", payload);
    return true;
  } catch (error) {
    throw error;
  }
};

const resetPassword = async (payload) => {
  try {
    if (!payload.token) {
      throw new Error("token invalid");
    }
   await axios.post("/v1/reset-password", payload);
  } catch (error) {
    throw error;
  }
};

// funções suporte ...
const updateSession = (data, authStore) => {
  const response = {
    data: data.data,
    token: data.authorization.token,
  };
  cookie.setCookieAuth(response.data, response.token);
  authStore.updateAuthState({
    isAuth: true,
    session: {
      user: response.data,
      token: response.token,
    },
  });
  return response;
};

export default {
  getDataUserAuth,
  makeLogin,
  makeLogout,
  makeRegisterAndLogin,
  forgotPassword,
  resetPassword,
};
