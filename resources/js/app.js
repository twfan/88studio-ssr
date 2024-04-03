import "./bootstrap";
import "../css/app.css";

import "../../node_modules/@chenfengyuan/datepicker/src/index.js";
import "../../node_modules/@chenfengyuan/datepicker/src/index.scss";

// import { tns } from "./node_modules/tiny-slider/src/tiny-slider"
import { tns } from "../../node_modules/tiny-slider/src/tiny-slider";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function confirmDelete(deleteUrl) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, redirect to the delete URL
            window.location.href = deleteUrl;
        }
    });
}

document.querySelectorAll(".my-slider").forEach((slider) => {
    tns({
        container: slider,
        items: 1,
        slideBy: "page",
        autoplay: true,
        mouseDrag: true,
        speed: 900,
        controlsContainer: ".nav-slider",
        prevButton: ".prev",
        nextButton: ".next",
        autoplayButton: false,
        autoplayText: ["", ""],
        autoplayButtonOutput: false,
    });
});

document.querySelectorAll(".my-slider-static-emote").forEach((slider) => {
    tns({
        container: slider,
        items: 1,
        slideBy: "page",
        autoplay: true,
        speed: 400,
        nav: false,
        controls: false,
        autoplayButton: false,
        autoplayText: ["", ""],
        autoplayButtonOutput: false,
    });
});
