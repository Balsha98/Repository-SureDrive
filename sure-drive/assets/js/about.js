import { divToTop } from "./general.js";

// ***** DOM ELEMENTS ***** //
const heroSection = $(".section-hero");
const testimonialsList = $(".testimonials-list");
const carouselLineItems = $(".carousel-lines-list-item");
let testimonialsListItems;

// ***** VARIABLES ***** //
const translateX = [
    [50, 155, 265, 380, 495],
    [-55, 50, 155, 265, 380],
    [-165, -55, 50, 155, 265],
    [-280, -165, -55, 50, 155],
    [-395, -280, -165, -55, 50],
];

// Intersection observer.
const heroSectionObserver = new IntersectionObserver(
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
heroSectionObserver.observe(heroSection[0]);

// Hero welcome.
setTimeout(() => {
    ["container", "logo"].forEach((element) => $(`.section-hero-${element}`).toggleClass(`show-hero-${element}`));
}, 500);

// ***** FUNCTIONS ***** //
const generateTestimonials = async function () {
    const testimonials = await fetch(`assets/json/testimonials.json?ts=${new Date().getTime()}`)
        .then((response) => response.json())
        .then((response) => response);

    let i = 1;
    for (const { heading, quote, image, name, location } of testimonials) {
        testimonialsList.append(`
            <li class="testimonials-list-item ${i === 2 ? "active-testimonial" : ""}" data-carousel-index="${i++}">
                <div class="div-testimonial-text-container">
                    <h3 class="heading-tertiary">${heading}</h3>
                    <blockquote class="testimonial-quote">
                        ${quote}
                    </blockquote>
                </div>
                <div class="div-testimonial-profile-container">
                    <div class="div-testimonial-profile">
                        <img src="assets/media/${image}" alt="Testimonial Image #1">
                        <div class="div-testimonial-profile-text-container">
                            <p>${name}</p>
                            <span>${location}</span>
                        </div>
                    </div>
                    <ul class="testimonial-ratings-list">
                        <li class="testimonial-ratings-list-item">
                            <ion-icon name="star"></ion-icon>
                        </li>
                        <li class="testimonial-ratings-list-item">
                            <ion-icon name="star"></ion-icon>
                        </li>
                        <li class="testimonial-ratings-list-item">
                            <ion-icon name="star"></ion-icon>
                        </li>
                        <li class="testimonial-ratings-list-item">
                            <ion-icon name="star"></ion-icon>
                        </li>
                        <li class="testimonial-ratings-list-item">
                            <ion-icon name="star"></ion-icon>
                        </li>
                    </ul>
                </div>
            </li>
        `);
    }

    // Set event listeners.
    testimonialsListItems = $(".testimonials-list-item");
    testimonialsListItems.each((_, li) => {
        $(li).click(setTestimonialIntoView);
    });
};

const setTestimonialIntoView = function () {
    const classAttr = $(this).attr("class");
    const carouselIndex = +$(this).data("carousel-index");

    testimonialsListItems.each((_, li) => {
        if ($(li).hasClass("active-testimonial")) {
            $(li).removeClass("active-testimonial");
        }

        if (classAttr.includes("testimonials")) {
            $(this).addClass("active-testimonial");
        }
    });

    carouselLineItems.each((i, li) => {
        if ($(li).hasClass("active-line")) {
            $(li).removeClass("active-line");
        }

        if (i === carouselIndex) {
            $(li).addClass("active-line");
        }
    });
};

// Generate testimonials.
generateTestimonials();

// ***** EVENT LISTENERS ***** //
// Spin testimonial carousel.
carouselLineItems.each((_, li) => {
    $(li).click(setTestimonialIntoView);
});
