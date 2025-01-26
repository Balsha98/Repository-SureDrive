import { divToTop } from "../general.js";
import { handleRequest } from "../request.js";

// ***** DOM ELEMENTS ***** //
const popupCloseBtns = $(".btn-close-popup");
const modifyImgPopup = $(".popup-modify-img");
const modifyCommissionPopup = $(".popup-modify-commission");
const deletePopup = $(".popup-delete");
const cancelBtns = $(".btn-cancel");
const imgSubmitBtn = $(".btn-img-submit");
const commissionSubmitBtn = $(".btn-commission-submit");
const formSubmitBtns = $(".btn-form-submit");
const deleteBtn = $(".btn-delete");
const userDetailsSection = $(".section-user-details");
const saveProfileBtn = $(".btn-save-profile");
const editImgBtns = $(".btn-edit-img");
const editCommissionBtn = $(".btn-edit-commission");
const labelImgUploads = $(".label-img-upload");
const listHeaders = $(".list-container-header");
const showCarEditBtnsTogglers = $(".btn-toggle-car-edit-btns");
const carEditBtnsContainers = $(".div-car-edit-btns-container");
const modifyBtns = $(".btn-modify");
const trashBtns = $(".btn-trash");

// Variables.
const userInputs = ["id", "username", "email", "phone", "image", "location", "role_id"];
const carInputs = [
    "id",
    "seller_id",
    "owner_id",
    "make",
    "model",
    "year",
    "note",
    "image",
    "fuel",
    "shift",
    "mileage",
    "horse_power",
    "color",
    "original_price",
    "final_price",
];

// Intersection observer.
const profileObserver = new IntersectionObserver(
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
profileObserver.observe(userDetailsSection[0]);

// ***** FUNCTIONS ***** //
const closePopup = function () {
    const parent = $(this.closest(".div-popup"));
    parent.toggleClass("show-popup");
};

const showPopup = function (popup) {
    popup.toggleClass("show-popup");
};

const toggleList = function () {
    listHeaders.each((_, header) => {
        const currClass = $(this).attr("class").split(" ")[1];
        const headerClass = $(header).attr("class").split(" ")[1];

        if (currClass !== headerClass) {
            if ($(header).hasClass("active-list-container-header")) {
                $(header).removeClass("active-list-container-header");
            }
        }
    });

    $(this).toggleClass("active-list-container-header");

    const parent = $(this.closest(".div-list-container"));
    const parentClass = parent.attr("class").split(" ")[1];

    const itemsList = $(`.${parentClass} .div-scroll-list-container`);
    itemsList.toggleClass("hide-element");

    this.scrollIntoView();
};

const showCarEditBtns = function () {
    const containerID = $(this).data("container-id");
    const relContainer = $([...carEditBtnsContainers].find((div) => +$(div).data("container-id") === containerID));
    relContainer.toggleClass("show-car-edit-btns");
};

// Popup altering functions.
const setModifyImgPopup = function () {
    const [imgType, imgID] = getImgID(this);

    // Set visuals.
    $(".span-item-upper").text(capitalizeWord(imgType));
    $(".span-item-lower").text(imgType);
    $(".span-item-id").text(imgID);

    // Set input img container.
    $(".div-modify-img-container").addClass(`${imgType}-img-container`);
    $(`.${imgType}-img-container label`).attr("for", `add_${imgType}_image`);
    $(`.${imgType}-img-container label`).data("img-type", imgType);
    $(`.${imgType}-img-container input`).attr("id", `add_${imgType}_image`);

    // Set hidden inputs.
    $("#img_edit_id").val(imgID);
    $("#img_edit_type").val(imgType);

    showPopup(modifyImgPopup);
};

const showCommissionPopup = function () {
    showPopup(modifyCommissionPopup);
};

const setModifyItemPopup = function () {
    const [itemType, itemID] = getCardID(this);

    // Determine action.
    const idNotNum = isNaN(itemID);
    let action = idNotNum ? "add" : "edit";
    let method = idNotNum ? "POST" : "PUT";

    // Set visuals.
    $(".span-action-lower").text(action);
    $(".span-action-upper").text(capitalizeWord(action));
    $(`.form-modify-${itemType}`).attr("method", method);

    // Toggle forms
    if (idNotNum) {
        $(`.form-add-${itemType}`).removeClass("hide-element");
        $(`.form-edit-${itemType}`).addClass("hide-element");
    } else {
        $(`.form-add-${itemType}`).addClass("hide-element");
        $(`.form-edit-${itemType}`).removeClass("hide-element");
    }

    $(`.btn-form-submit`).text(capitalizeWord(action));

    // Reset inputs.
    for (const input of itemType === "user" ? userInputs : carInputs) {
        $(`#${action}_${itemType}_${input}`).val(idNotNum ? "" : $(`#edit_${itemType}_${input}_${itemID}`).val());
    }

    // Show/hide popup.
    showPopup($(`.popup-modify-${itemType}`));
};

const setDeletePopup = function () {
    const [itemType, itemID] = getCardID(this);

    // Set visuals.
    $(".span-item-upper").text(capitalizeWord(itemType));
    $(".span-item-lower").text(itemType);
    $(".span-item-id").text(itemID);

    // Populate inputs.
    $("#item_delete_type").val(itemType);
    $("#item_delete_id").val(itemID);

    // Show/hide popup.
    showPopup(deletePopup);
};

// Data altering functions.
const saveProfile = function (event) {
    event.preventDefault();

    const form = $(this.closest(".form"));
    const url = form.attr("action");
    const method = form.attr("method");

    const data = {};
    data["item_type"] = "profile";
    const profileInputs = ["id", "username", "email", "phone", "location"];
    profileInputs.forEach((input) => {
        let value = $(`#edit_profile_${input}`).val();
        if (!isNaN(value)) {
            value = +value;
        }

        data[`edit_profile_${input}`] = value;
    });

    handleRequest(url, method, "/profile", data);
};

const modifyItemImg = function (event) {
    event.preventDefault();

    const form = $(this.closest(".form"));
    const url = form.attr("action");
    const method = form.attr("method");

    const data = new FormData();
    const imgID = $("#img_edit_id").val();
    const imgType = $("#img_edit_type").val();
    const image = $(`#add_${imgType}_image`)[0].files[0];

    data.append("img_edit_id", imgID);
    data.append("img_edit_type", imgType);
    data.append("image", image);

    handleRequest(url, method, "/profile", data, "form");
};

const saveSellerCommission = function (event) {
    event.preventDefault();

    const form = $(this.closest(".form"));
    const url = form.attr("action");
    const method = form.attr("method");

    const data = {};
    data["commission_edit_id"] = $("#commission_edit_id").val();
    data["commission"] = $("#commission").val();

    handleRequest(url, method, "/profile", data);
};

const modifyItemCard = function (event) {
    event.preventDefault();

    const form = $(this.closest(".form"));
    const [itemType, actionType] = form.data("form-type").split("/");
    const url = form.attr("action");
    const method = form.attr("method");

    const isActionAdd = actionType === "add";
    const data = isActionAdd ? new FormData() : {};

    if (isActionAdd) {
        data.append("item_type", itemType);
    } else {
        data["item_type"] = itemType;
    }

    const inputs = itemType === "user" ? userInputs : carInputs;
    for (const input of inputs) {
        if (input === "image") {
            if (actionType === "add") {
                const image = $(`#${actionType}_${itemType}_${input}`)[0].files[0];
                data.append(`${actionType}_${itemType}_${input}`, image);
            }

            continue;
        }

        let value = $(`#${actionType}_${itemType}_${input}`).val();
        if (!isNaN(value)) {
            value = +value;
        }

        if (isActionAdd) {
            data.append(`${actionType}_${itemType}_${input}`, value);
        } else {
            data[`${actionType}_${itemType}_${input}`] = value;
        }
    }

    handleRequest(url, method, "/profile", data, isActionAdd ? "form" : "json");
};

const deleteItemCard = function (event) {
    event.preventDefault();

    const form = $(this.closest(".form"));
    const url = form.attr("action");
    const method = form.attr("method");

    const data = {};
    data["item_delete_id"] = $("#item_delete_id").val();
    data["item_delete_type"] = $("#item_delete_type").val();

    handleRequest(url, method, "/profile", data);
};

// Helper functions.
const startImgInterval = function () {
    const imgType = $(this).data("img-type");
    setInterval(() => waitForImage(imgType), 1000);
};

const waitForImage = function (imgType) {
    const value = $(`#add_${imgType}_image`).val();
    if (value) {
        const img = value.split("\\")[2];
        $(`.${imgType}-img-container`).attr("data-content", img);
    }
};

const getImgID = function (btn) {
    const parent = $(btn.closest(".div-edit-btn-icon-container"));
    return parent.data("img-id").split("/");
};

const getCardID = function (item) {
    const parent = $(item.closest(".items-list-item"));
    return parent.data("card-id").split("/");
};

const capitalizeWord = function (word) {
    return word[0].toUpperCase() + word.slice(1);
};

// ***** EVENT LISTENERS ***** //
popupCloseBtns.each((_, btn) => {
    $(btn).click(closePopup);
});

cancelBtns.each((_, btn) => {
    $(btn).click(closePopup);
});

imgSubmitBtn.click(modifyItemImg);

commissionSubmitBtn.click(saveSellerCommission);

formSubmitBtns.each((_, btn) => {
    $(btn).click(modifyItemCard);
});

deleteBtn.click(deleteItemCard);

saveProfileBtn.click(saveProfile);

labelImgUploads.each((_, label) => {
    $(label).click(startImgInterval);
});

listHeaders.each((_, header) => {
    $(header).click(toggleList);
});

editImgBtns.each((_, btn) => {
    $(btn).click(setModifyImgPopup);
});

editCommissionBtn.click(showCommissionPopup);

showCarEditBtnsTogglers.each((_, btn) => {
    $(btn).click(showCarEditBtns);
});

modifyBtns.each((_, btn) => {
    $(btn).click(setModifyItemPopup);
});

trashBtns.each((_, btn) => {
    $(btn).click(setDeletePopup);
});
