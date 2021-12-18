import React, { useState, useMemo, useRef, useEffect } from "react";
import ReactSpeedometer from "react-d3-speedometer";
import Box from "@mui/material/Box";
import Slider from "@mui/material/Slider";

const Speedometer = ({ items, variables, lastStep, lastValue }) => {
  const sliderRef = useRef(null);
  const speedoRef = useRef(null);

  const {
    show,
    showMarks,
    rightLabel,
    leftLabel,
    gapSize,
    textAlign,
    gapColor,
    needleSize,
    ringSize,
    unfilledSegmentColor,
    initialSegmentStyle
  } = variables;
  //console.log(variables);
  const [currentValue, setCurrentValue] = useState(lastValue || 0);
  const [currentStep, setCurrentStep] = useState(lastStep || 0);
  const [segmentStyles, setSegmentStyles] = useState(initialSegmentStyle);

  useEffect(() => {
    if (sliderRef.current) {
      const marks = sliderRef.current.querySelectorAll(".MuiSlider-mark");
      console.log({showMarks})
      if (showMarks && marks.length >= 1) {
        marks[0].style.display = "none";
        marks[marks.length - 1].style.display = "none";
      }
    }
    if (speedoRef.current) {
      const meter = speedoRef.current.querySelector(".speedometer");
      if (meter) {
        meter.style.height = "inherit";
        meter.removeAttribute("height");
      }
    }
  }, []);

  const maxValue = 180;
  const length = items ? items.length : 0;
  const step = (180 - gapSize * (length - 1)) / length;

  const customProps = useMemo(() => {
    let stepCounter = 1;
    let gapCounter = 1;
    let data = 0;
    const stops = new Array(length * 2).fill(0).map((e, idx) => {
      if (idx) {
        if (idx == 1) {
          return step;
        }

        data = step * stepCounter + gapSize * gapCounter;

        if (idx % 2 != 0) gapCounter++;
        if (idx % 2 == 0) stepCounter++;
        return data;
      }
      return idx;
    });
    let counter = 0;
    const colors = new Array(length * 2).fill(0).map((e, idx) => {
      if (idx % 2 == 0) {
        const color = items[counter].dataColor;
        counter++;
        return color;
      }
      return gapColor;
    });

    return { stops, colors };
  }, []);
  const { stops, colors } = customProps;

  const onChange = (event) => {
    const value = event.target.value;

    const step = parseInt((value * length) / maxValue);

    const setValue = value == 0 || value == maxValue ? value : value - gapSize;
    const emptyObject = {};
    emptyObject[`& .arc path:nth-child(odd):nth-child(n+${step * 2})`] = {
      fill: `${unfilledSegmentColor} !important`,
    };
    setSegmentStyles(emptyObject);
    setCurrentValue((lastVal) => {
      window.kocCurrentValue = setValue;
      return setValue;
    });
    setCurrentStep((lastStep) => {
      window.kocCurrentStep = step;
      return step;
    });
  };

  const Items = () =>
    items.map((item, idx) => (
      <Box
        style={{
          display: `${currentStep == idx + 1 ? "block" : "none"}`,
        }}
        className={`${item.className}`}
      >
        <div className="text" style={{ textAlign: textAlign }}>
          <p>{item.text}</p>
        </div>
        <div className="medias">
          {item.medias
            .filter(
              (media) =>
                !media.src.includes("/elementor/assets/images/placeholder.png")
            )
            .map((media) => (
              <img
                className={media.className}
                src={media.src}
                alt=""
                style={media.style}
              />
            ))}
        </div>
      </Box>
    ));

  return (
    <Box sx={segmentStyles}>
      <Items className="items" />
      <div className="slider-inner-container" ref={speedoRef}>
        <ReactSpeedometer
          fluidWidth={true}
          className="speedometer"
          value={currentValue}
          customSegmentStops={stops}
          segmentColors={colors}
          minValue={0}
          needleHeightRatio={needleSize}
          ringWidth={Number(ringSize)}
          maxValue={maxValue}
          labelFontSize={0}
          valueTextFontSize={0}
        />
      </div>
      <Box className="slider-track-container">
        <p className="label-slider label-right">{rightLabel}</p>
        <p className="label-slider label-left">{leftLabel}</p>
        <Slider
          className="slider"
          aria-label="slider-koc"
          defaultValue={currentValue}
          step={180 / length}
          onChange={onChange}
          min={0}
          max={maxValue}
          marks={showMarks}
          ref={sliderRef}
        />
      </Box>
    </Box>
  );
};

export default Speedometer;
