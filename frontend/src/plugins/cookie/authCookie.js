import Cookie from "js-cookie";

const NAME_COOKIE_USER = "user_data";
const NAME_COOKIE_TOKEN = "user_token";

const setCookieAuth = (user, token) => {
  Cookie.set(NAME_COOKIE_USER, user, {
    expires: 30,
    secure: true,
    path: "http://localhost:5173",
  });
  Cookie.set(NAME_COOKIE_TOKEN, token, {
    expires: 30,
    secure: true,
    path: "http://localhost:5173",
  });
};

const getCookieAuth = (name = NAME_COOKIE_TOKEN) => {
  return Cookie.get(name);
};
const removeCookieAuthAll = () => {
  Cookie.remove(NAME_COOKIE_TOKEN);
  Cookie.remove(NAME_COOKIE_USER);
};
const removeCookieToken = (name = NAME_COOKIE_TOKEN) => {
  Cookie.remove(name);
};
const removeCookieUser = (name = NAME_COOKIE_USER) => {
  Cookie.remove(name);
};

export default {
  setCookieAuth,
  getCookieAuth,
  removeCookieToken,
  removeCookieUser,
  removeCookieAuthAll
};
