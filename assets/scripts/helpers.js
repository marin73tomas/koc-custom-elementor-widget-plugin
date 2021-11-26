
export function applyFill(slider, trackColor) {
  console.log(trackColor);
  // Let's turn our value into a percentage to figure out how far it is in between the min and max of our input
  const settings = {
    fill: "gray",
    background: "#d7dcdf",
  };
  const percentage =
    (100 * (slider.value - slider.min)) / (slider.max - slider.min);
  // now we'll create a linear gradient that separates at the above point
  // Our background color will change here
  const bg = `linear-gradient(90deg, ${
    trackColor || settings.fill
  } ${percentage}%, ${settings.background} ${percentage + 0.1}%)`;
  slider.style.background = bg;
}
export function round(num, fixed) {
  var re = new RegExp("^-?\\d+(?:.\\d{0," + (fixed || -1) + "})?");
  return num.toString().match(re)[0];
}
