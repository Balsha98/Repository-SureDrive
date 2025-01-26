"use strict";

const setCookie = function (key, value) {
    document.cookie = `${key}=${value};`;
};

const unsetCookie = function (key) {
    document.cookie = `${key}=0; expires=${new Date(0)};`;
};

const getCookie = function (key) {
    const cookies = document.cookie.split(";");
    for (let cookie of cookies) {
        const cookieParts = cookie.trim().split("=");
        if (cookieParts[0] === key) {
            return cookieParts[1];
        }
    }
};

export { setCookie, unsetCookie, getCookie };
