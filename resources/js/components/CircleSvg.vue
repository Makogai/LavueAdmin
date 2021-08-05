<template>
  <svg
    :height="h"
    :stroke="stroke"
    viewBox="0 0 38 38"
    :width="w"
    xmlns="http://www.w3.org/2000/svg"
  >
    <g fill="none" fill-rule="evenodd">
      <g stroke-width="2" transform="translate(1 1)">
        <circle cx="18" cy="18" r="18" stroke-opacity=".8"/>
        <path d="M36 18c0-9.94-8.06-18-18-18">
          <animateTransform
            attributeName="transform"
            dur="1s"
            from="0 18 18"
            repeatCount="indefinite"
            to="360 18 18"
            type="rotate"
          />
        </path>
      </g>
    </g>
  </svg>
</template>

<script>
export default {
  props: {
    stroke: {
      type: String,
      default: '#fff'
    },
    w: {
      type: Number,
      default: 26
    },
    h: {
      type: Number,
      default: 26
    }
  },
  computed: {
    viewBox () {
      return '0 0 ' + this.w + ' ' + this.h
    }
  }
}
</script>
