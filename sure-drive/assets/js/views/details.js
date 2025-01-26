import { divToTop } from "../general.js";

// ***** DOM ELEMENTS ***** //
const carUserSection = $(".section-car-user-details");
const btnShowUser = $(".div-user-btn-container");
const divUserDetails = $(".div-user-details-container");
const btnCloseUser = $(".btn-close-user");
const colorSpan = $(".color span");

// Intersection observer.
const carUserSectionObserver = new IntersectionObserver(
    function (entry) {
        const [{ isIntersecting }] = entry;

        if (!isIntersecting) {
            divToTop.addClass("show-to-top-btn");
            return;
        }

        divToTop.removeClass("show-to-top-btn");
    },
    { root: null, threshold: 0 }
);
carUserSectionObserver.observe(carUserSection[0]);

// ***** FUNCTIONS ***** //
// Show/hide user details.
const toggleUserDetails = function () {
    btnShowUser.toggleClass("hide-btn");
    divUserDetails.toggleClass("show-user-details");
};

const setCarColor = function () {
    const color = colorSpan.data("color");
    colorSpan[0].style = `
        color: ${color};
        background-color: ${color};
    `;
};

setCarColor();

// ***** EVENT LISTENERS ***** //
// Show/hide user details.
btnShowUser.click(toggleUserDetails);

// Show/hide user details.
btnCloseUser.click(toggleUserDetails);
