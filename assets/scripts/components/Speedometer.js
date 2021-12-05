import React, { useState, useMemo } from "react";
import ReactSpeedometer from "react-d3-speedometer";
import Box from "@mui/material/Box";
import Slider from "@mui/material/Slider";

const Speedometer = ({
  items,
  gapSize = 2,
  gapColor = "white",
  width,
  height,
  dimensionUnit,
}) => {
  const [currentValue, setCurrentValue] = useState(0);
  const maxValue = 180;
  const length = items ? items.length : 0;
  const step = 180 / length;
  const onChange = (event) => {
    setCurrentValue(event.target.value);
  };

  const Items = () =>
    items.map((item, idx) => (
      <Box
        style={{
          display: `${maxValue / currentValue == idx + 1 ? "block" : "none"}`,
        }}
      >
        <div className="text">
          {item.querySelector(".text p")?.innerHTML || ""}
        </div>
        <div className="medias">
          {Array.from(item.querySelectorAll(".medias .media")).map((media) => (
            <img
              className="media"
              src={media.innerHTML}
              alt={[...media.classList].join("")}
            />
          ))}
        </div>
      </Box>
    ));
  const customSegmentsStops = useMemo(() => {
    let counter = 1;
    let data = 0;
    return [
      0,
      ...new Array(length * 2).fill(0).map((e, idx) => {
        if (idx % 2 == 0) {
          data = step * counter - gapSize;
          counter++;
          return data;
        }
        return data + gapSize;
      }),
      180,
    ];
  }, [step, gapSize]);

  return (
    <Box>
      <Items className="items" />
      <ReactSpeedometer
        className="speedometer"
        value={currentValue}
        customSegmentStops={customSegmentsStops}
        minValue={0}
        maxValue={maxValue}
        segments={length * 2} //steps + nGaps
        labelFontSize={0}
        valueTextFontSize={0}
      />
      <Slider
        className="slider"
        aria-label="slider-koc"
        defaultValue={currentValue}
        step={step}
        onChange={onChange}
        min={0}
        max={maxValue}
      />
    </Box>
  );
};

export default Speedometer;
