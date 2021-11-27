import * as helpers from "./helpers.js";

export async function setUpCustomSlider(cont) {
  const container =
    cont && cont.length >= 1 && document.querySelector(`#${cont[0].id}`);

  if (container) {
    const section = container.closest("section");
    const hidePlaceHolders = document.createElement("style");
    //hide weird spacing bug below the slider
    hidePlaceHolders.innerHTML = `
    .${[...section.classList].find(
      (c) =>
        c != "elementor-element-edit-mode" && c.includes("elementor-element-")
    )} .placeholder-height{
      display: none !important;
    }
    `;
    document.body.appendChild(hidePlaceHolders);
    if (!window.last) window.last = 0;

    if (section) {
      section.classList.add(
        "elementor-section-full_width",
        "elementor-section-stretched",
        "elementor-section-height-default",
        "elementor-section-height-default"
      );
      section.setAttribute(
        "data-settings",
        "{&quot;stretch_section&quot;:&quot;section-stretched&quot;}"
      );
      section.classList.remove("elementor-section-boxed");
      section.style.position = "static";
      section.firstElementChild.style.position = "absolute";
      section.firstElementChild.style.left = 0;
      section.firstElementChild.style.zIndex = 2;
      const placeHolder = document.createElement("div");
      placeHolder.style.height = "600px";
      placeHolder.className = "placeholder-height";
      section.appendChild(placeHolder);
    }
    const wrapper = container.parentElement;

    const bgColor = wrapper.querySelector(".cs-bg")?.innerHTML || "white";
    const trackColor = wrapper.querySelector(".track-color")?.innerHTML;
    const thumbColor = wrapper.querySelector(".thumb-color")?.innerHTML;
    const thumbHoverColor =
      wrapper.querySelector(".thumb-hover-color")?.innerHTML;
    const styleThumb = document.createElement("style");
    styleThumb.innerHTML = `

    .cs-wrapper input::-moz-range-thumb{
      background: ${thumbColor} !important;
    }
    .cs-wrapper input::-webkit-slider-thumb {
    background: ${thumbColor} !important;
    }
    .cs-wrapper input:active::-moz-range-thumb{
      background: ${thumbHoverColor} !important;
    }
    .cs-wrapper input::-moz-range-thumb:hover {
    background: ${thumbHoverColor} !important;
    }
    .cs-wrapper input:active::-moz-range-thumb {
   background: ${thumbHoverColor} !important;
    }
    .cs-wrapper input::-webkit-slider-thumb:hover {
    background: ${thumbHoverColor} !important;
    }
    .cs-wrapper input:active::-webkit-slider-thumb {
    background: ${thumbHoverColor} !important;
    } 
    `;
    wrapper.appendChild(styleThumb);
    const meter = container.querySelector(".meter");
    const white = container.querySelector(".white");
    const chamber = container.querySelectorAll(".chamber");
    const gradient = container.querySelector(".gradient");
    var black = container.getElementsByClassName("black")[0];
    var tick = container.getElementsByClassName("tick")[0];
    gradient.style.height = "17vw";
    gradient.style.width = "17vw";
    white.style.height = "9vw";
    white.style.width = "9vw";
    tick.style.width = "9vw";
    let animationInterval = 0;
    let stylePrint = false;
    chamber.forEach((e, idx) => {
      if (idx == 0) e.classList.add("active");
      e.style.background = `linear-gradient(to right, ${bgColor} 50%, ${bgColor} 50%)`;

      if (!stylePrint) {
        const styling = `#${cont[0].id} .chamber { 
      transform: translate(-50%, -50%)rotateZ(calc(var(--i)*-${
        180 / chamber.length
      }deg));
    }
      `;
        const style = document.createElement("style");
        style.innerHTML = styling;
        document.body.appendChild(style);
        stylePrint = true;
      }
    });

    white.style.backgroundColor = bgColor;
    meter.style.backgroundColor = bgColor;
    const nSteps = chamber.length;

    var m = wrapper.querySelector(".cs-range-slider .m");
    const steps = helpers.round(100 / nSteps, 4);
    const stepsNumbers = Array.from(chamber).map((e, idx) =>
      helpers.round(Number(steps * idx), 4)
    );
    m.setAttribute("step", `${steps}`);
    var mValue = wrapper.querySelector(".cs-range-slider span");

    mValue.innerHTML = 0;
    const texts = wrapper.querySelectorAll(".text-item");

    m.addEventListener("input", function () {
      const allImages = wrapper.querySelectorAll(`.img-container img`);
      allImages.forEach((img) =>
        img.classList.remove("animated", "visible-img")
      );

      black.style.transform = tick.style.transform =
        "translate(-50%,-50%)scaleX(-1)rotateZ(-" +
        (180 / 100) * m.value +
        "deg)";

      let stepVal = stepsNumbers
        .map(
          (e, idx) =>
            helpers.round(Number(e), 2) == helpers.round(Number(m.value), 2) &&
            idx
        )
        .filter((e) => e);

      let currentStep =
        (stepVal.length >= 1 && stepVal[0]) || (m.value == 100 ? nSteps : 0);

      mValue.innerHTML = currentStep;
      window.last = currentStep;

      const images = wrapper
        .querySelectorAll(`.img-container .media`)
        ?.[currentStep - 1]?.querySelectorAll("img");

      (images || []).forEach(
        (img) =>
          !img.src.includes("/elementor/assets/images/placeholder.png") &&
          img.classList.add("animated", "visible-img")
      );

      texts.forEach((e) => {
        e.style.display = "none";
        e.style.opacity = 1;
      });

      if (currentStep) {
        texts[currentStep - 1].style.display = "block";
        texts[currentStep - 1].style.opacity = 1;
      }

      var gVal = 180 - (180 / nSteps) * currentStep * -1;
      gradient.style.transform = "translate(-50%,-50%)rotateZ(" + gVal + "deg)";

      // 2. apply our fill to the input
      helpers.applyFill(m, trackColor);
    });

    m.value = m.step * window.last;

    var event = new Event("input", {
      bubbles: true,
      cancelable: true,
    });

    m.dispatchEvent(event);

    black.style.transform = tick.style.transform =
      "translate(-50%,-50%)scaleX(-1)rotateZ(-" +
      (180 / 100) * m.value +
      "deg)";
    texts.forEach((e) => {
      const eHeight = e.style.height;
      const pHeight = e.parentElement.style.height;

      e.parentElement.style.height = !pHeight
        ? eHeight
        : (pHeight < eHeight && eHeight) || pHeight;
    });
    helpers.applyFill(m, trackColor);
  }
}
