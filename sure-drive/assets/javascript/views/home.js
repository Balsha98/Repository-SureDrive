import { divToTop, openPage, saveLastViewedCar } from "../helpers/general.js";
import { handleRequest } from "../helpers/request.js";

// ***** DOM ELEMENTS ***** //
const sectionHero = $(".section-hero");
const heroCarContainers = $(".div-hero-img-container");
const carouselBtns = $(".btn-carousel");
const heroDots = $(".lines-list-item");
const sectionCars = $(".section-cars");
const checkboxDivs = $(".div-checkbox");
const btnFilter = $(".btn-filter");
const filterOptions = $(".aside-filter-options");
const asideOverlay = $(".aside-overlay");
const asideBtns = $(".aside-icon-btn");
const carsGridContainer = $(".div-cars-grid-container");
const carContainerCards = $(".div-car-card-container");
const selectSort = $(".select-sort");

// Variables.
let currCarIndex = 1;
const xValues = [
  [0, 100, 200],
  [-100, 0, 100],
  [-200, -100, 0],
];

// Intersection observer.
const heroObserver = new IntersectionObserver(
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
heroObserver.observe(sectionHero[0]);

// ***** FUNCTIONS ***** //
const setActiveHeroDot = function (curr) {
  heroDots.each((_, li) => {
    if ($(li).hasClass("active-line")) {
      $(li).removeClass("active-line");
    }

    $(curr).addClass("active-line");
  });
};

const getHeroCarContainer = function (index) {
  heroCarContainers.each((i, div) => {
    div.style = `transform: translateX(${xValues[index - 1][i]}%);`;

    const carIndex = +$(div).data("hero-car");
    if (carIndex === index) {
      $(".heading-car-name").text($(div).data("name"));
      $(".span-production-year").text($(div).data("year"));
      $(".btn-view-details").attr("href", `/details/${$(div).data("id")}`);
    }
  });
};

const turnCarouselUsingBtns = function () {
  if ($(this).data("direction") === "prev") {
    currCarIndex--;

    // Reset index.
    if (currCarIndex < 1) {
      currCarIndex = xValues.length;
    }

    getHeroCarContainer(currCarIndex);
  } else if ($(this).data("direction") === "next") {
    currCarIndex++;

    // Reset index.
    if (currCarIndex > xValues.length) {
      currCarIndex = 1;
    }

    getHeroCarContainer(currCarIndex);
  }

  const activeDot = [...heroDots].find(
    (li) => +$(li).data("hero-car") === currCarIndex
  );
  setActiveHeroDot(activeDot);
};

const turnCarCarouselUsingDots = function () {
  setActiveHeroDot(this);

  currCarIndex = +$(this).data("hero-car");
  getHeroCarContainer(currCarIndex);
};

const toggleFilterOptions = function () {
  filterOptions.toggleClass("show-filter-options");
  asideOverlay.toggleClass("show-overlay");
};

const toggleCheckbox = function () {
  $(this).toggleClass("checked");
};

const clearFilterOptions = function () {
  for (const column of ["year", "mileage", "price"]) {
    for (const limit of ["min", "max"]) {
      $(`#range_${column}_${limit}`).val("");
    }
  }

  checkboxDivs.each((_, div) => {
    if ($(div).hasClass("checked")) {
      $(div).removeClass("checked");
    }
  });
};

const filterCars = function (event) {
  event.preventDefault();

  const filterData = {};
  const checkBoxLists = $(".checkbox-list");
  checkBoxLists.each((_, ul) => {
    const listName = $(ul).attr("class").split(" ")[1];
    const filterName = $(ul).data("filter-name");
    const isColumn =
      filterName === "make" || filterName === "fuel" || filterName === "shift";

    const data = [];
    const checkedFilters = $(`.${listName} .checked`);
    checkedFilters.each((_, box) => {
      const parentListItem = $(box.closest(".checkbox-list-item"));
      if (isColumn) {
        data.push(parentListItem.data(filterName));
      } else {
        for (const limit of ["min", "max"])
          data.push(parentListItem.data(limit));
      }
    });

    if (data.length !== 0) {
      if (isColumn) {
        filterData[filterName] = data;
      } else {
        filterData[filterName] = [Math.min(...data), Math.max(...data)];
      }
    } else if (!isColumn) {
      const inputMin = $(`#range_${filterName}_min`).val();
      const inputMax = $(`#range_${filterName}_max`).val();

      if (inputMin && inputMax) {
        filterData[filterName] = [inputMin, inputMax];
      }
    }
  });

  if (Object.keys(filterData).length === 0) return;

  const form = $(this.closest(".form"));
  const url = form.attr("action");
  const method = form.attr("method");

  sectionCars[0].scrollIntoView();
  handleRequest(url, method, "/home", filterData);
  toggleFilterOptions();
  clearFilterOptions();
};

const sortAvailableCars = function () {
  if (+$(this).val() === 0) return;

  const sortValues = $(this).val().split("/");
  const currAvailableCars = $(".div-car-card-container");
  const availableCars = [...currAvailableCars].sort((div1, div2) => {
    let value1 = $(div1).data(sortValues[0]);
    let value2 = $(div2).data(sortValues[0]);

    // Parse date.
    if (sortValues[0] === "date") {
      let dateParts = value1.split("-");
      value1 = new Date(dateParts[0], dateParts[1], dateParts[2]).getTime();

      dateParts = value2.split("-");
      value2 = new Date(dateParts[0], dateParts[1], dateParts[2]).getTime();
    }

    // Check sort order.
    if (sortValues[1] === "low") {
      return value1 - value2;
    }

    return value2 - value1;
  });

  // Refresh car grid container.
  carsGridContainer[0].innerHTML = "";
  availableCars.forEach((div) => {
    carsGridContainer.append(div);
  });
};

// ***** EVENT LISTENERS ***** //
// Car image carousel buttons.
carouselBtns.each((_, btn) => {
  $(btn).click(turnCarouselUsingBtns);
});

// Car image carousel dots.
heroDots.each((_, li) => {
  $(li).click(turnCarCarouselUsingDots);
});

// Toggle checkboxes.
checkboxDivs.each((_, div) => {
  $(div).click(toggleCheckbox);
});

// Show/hide filter options.
asideBtns.each((_, btn) => {
  $(btn).click(toggleFilterOptions);
});

// Button filter.
btnFilter.click(filterCars);

// Clickable car cards.
carContainerCards.each((_, div) => {
  $(div).click(function () {
    saveLastViewedCar($(this), "data");
    openPage($(this));
  });
});

// Sorting options select box.
selectSort.change(sortAvailableCars);
