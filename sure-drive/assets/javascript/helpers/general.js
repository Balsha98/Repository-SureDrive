import { setCookie } from "./cookie.js";

// ***** DOM ELEMENTS ***** //
const pageHeader = $(".page-header");
const logoContainer = $(".logo-container");
const sidebarBtns = $(".navbar-icon-btn");
const pageSidebar = $(".page-sidebar");
const sidebarOverlay = $(".page-sidebar-overlay");
const sidebarListItems = $(".sidebar-link-list-item");
const viewDetailsBtns = $(".btn-view-details");
const divToTop = $(".div-to-top-btn-container");
const subscribeBtn = $(".btn-subscribe");

// ***** FUNCTIONS ***** //
const togglePageSidebar = function () {
    pageSidebar.toggleClass("show-sidebar");
    sidebarOverlay.toggleClass("show-overlay");
};

const openPage = function (btn) {
    window.open(btn.data("href"), btn.data("target")).focus();
};

const saveLastViewedCar = function (btn, attr = "attr") {
    const hrefArr = (attr === "attr" ? btn.attr("href") : btn.data("href")).split("/");
    setCookie("last_viewed_car", hrefArr[hrefArr.length - 1]);
};

const toTopOfPage = function () {
    pageHeader[0].scrollIntoView();
};

// ***** EVENT LISTENERS ***** //
// Clickable logo container.
logoContainer.click(function () {
    openPage($(this));
});

// Show/hide sidebar buttons.
sidebarBtns.each((_, btn) => {
    $(btn).click(togglePageSidebar);
});

// Clickable sidebar list items.
sidebarListItems.each((_, li) => {
    $(li).click(function () {
        openPage($(this));
    });
});

// Set car id to view as a cookie.
viewDetailsBtns?.each((_, btn) => {
    $(btn).click(function () {
        saveLastViewedCar($(this));
    });
});

// Going to top of the page.
divToTop.click(toTopOfPage);

export { divToTop, openPage, saveLastViewedCar };
