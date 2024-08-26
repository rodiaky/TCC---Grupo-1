const prev = document.querySelector("#prev");
const next = document.querySelector("#next")
let carouselVp = document.querySelector("#carousel-vp")
let cCarouselInner = document.querySelector("#cCarousel-inner");
let carouselInnerWidth = cCarouselInner.getBoundingClientRect().width
let leftValue = 0

// Variable used to set the carousel movement value (card's width + gap)
const totalMovementSize =
parseFloat(
    document.querySelector(".cCarousel-item").getBoundingClientRect().width,
    10
) +
parseFloat(
    window.getComputedStyle(cCarouselInner).getPropertyValue("gap"),
    10
)
prev.addEventListener("click", () => {
if (!leftValue == 0) {
    leftValue -= -totalMovementSize;
    cCarouselInner.style.left = leftValue + "px";
}
})
next.addEventListener("click", () => {
const carouselVpWidth = carouselVp.getBoundingClientRect().width;
if (carouselInnerWidth - Math.abs(leftValue) > carouselVpWidth) {
    leftValue -= totalMovementSize;
    cCarouselInner.style.left = leftValue + "px";
}
})

const mediaQuery1200 = window.matchMedia("(min-width: 1200px)");
const mediaQuery992 = window.matchMedia("(min-width: 992px)");
const mediaQuery768 = window.matchMedia("min-width: 768px)");
const mediaQuery6001 = window.matchMedia("(min-width: 600px)");
const mediaQuery6002 = window.matchMedia("(max-width: 600px)")

mediaQuery1200.addEventListener("change", mediaManagement);
mediaQuery992.addEventListener("change", mediaManagement);
mediaQuery768.addEventListener("change", mediaManagement);
mediaQuery6001.addEventListener("change", mediaManagement);
mediaQuery6002.addEventListener("change", mediaManagement)

let oldViewportWidth = window.innerWidth

function mediaManagement() {
    const newViewportWidth = window.innerWidth
    if (leftValue <= -totalMovementSize && oldViewportWidth < newViewportWidth) {
        leftValue += totalMovementSize;
        cCarouselInner.style.left = leftValue + "px";
        oldViewportWidth = newViewportWidth;
    } else if (
        leftValue <= -totalMovementSize &&
        oldViewportWidth > newViewportWidth
    ) {
        leftValue -= totalMovementSize;
        cCarouselInner.style.left = leftValue + "px";
        oldViewportWidth = newViewportWidth;
    }
}