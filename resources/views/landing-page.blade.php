<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* ! tailwindcss v3.4.17 | MIT License | https://tailwindcss.com */
            *,
            :before,
            :after {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / .5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
                --tw-contain-size: ;
                --tw-contain-layout: ;
                --tw-contain-paint: ;
                --tw-contain-style:
            }

            ::backdrop {
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-pan-x: ;
                --tw-pan-y: ;
                --tw-pinch-zoom: ;
                --tw-scroll-snap-strictness: proximity;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ordinal: ;
                --tw-slashed-zero: ;
                --tw-numeric-figure: ;
                --tw-numeric-spacing: ;
                --tw-numeric-fraction: ;
                --tw-ring-inset: ;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgb(59 130 246 / .5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                --tw-backdrop-blur: ;
                --tw-backdrop-brightness: ;
                --tw-backdrop-contrast: ;
                --tw-backdrop-grayscale: ;
                --tw-backdrop-hue-rotate: ;
                --tw-backdrop-invert: ;
                --tw-backdrop-opacity: ;
                --tw-backdrop-saturate: ;
                --tw-backdrop-sepia: ;
                --tw-contain-size: ;
                --tw-contain-layout: ;
                --tw-contain-paint: ;
                --tw-contain-style:
            }

            *,
            :before,
            :after {
                box-sizing: border-box;
                border-width: 0;
                border-style: solid;
                border-color: #e5e7eb
            }

            :before,
            :after {
                --tw-content: ""
            }

            html,
            :host {
                line-height: 1.5;
                -webkit-text-size-adjust: 100%;
                -moz-tab-size: 4;
                -o-tab-size: 4;
                tab-size: 4;
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", Segoe UI Symbol, "Noto Color Emoji";
                font-feature-settings: normal;
                font-variation-settings: normal;
                -webkit-tap-highlight-color: transparent
            }

            body {
                margin: 0;
                line-height: inherit
            }

            hr {
                height: 0;
                color: inherit;
                border-top-width: 1px
            }

            abbr:where([title]) {
                -webkit-text-decoration: underline dotted;
                text-decoration: underline dotted
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-size: inherit;
                font-weight: inherit
            }

            a {
                color: inherit;
                text-decoration: inherit
            }

            b,
            strong {
                font-weight: bolder
            }

            code,
            kbd,
            samp,
            pre {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
                font-feature-settings: normal;
                font-variation-settings: normal;
                font-size: 1em
            }

            small {
                font-size: 80%
            }

            sub,
            sup {
                font-size: 75%;
                line-height: 0;
                position: relative;
                vertical-align: baseline
            }

            sub {
                bottom: -.25em
            }

            sup {
                top: -.5em
            }

            table {
                text-indent: 0;
                border-color: inherit;
                border-collapse: collapse
            }

            button,
            input,
            optgroup,
            select,
            textarea {
                font-family: inherit;
                font-feature-settings: inherit;
                font-variation-settings: inherit;
                font-size: 100%;
                font-weight: inherit;
                line-height: inherit;
                letter-spacing: inherit;
                color: inherit;
                margin: 0;
                padding: 0
            }

            button,
            select {
                text-transform: none
            }

            button,
            input:where([type=button]),
            input:where([type=reset]),
            input:where([type=submit]) {
                -webkit-appearance: button;
                background-color: transparent;
                background-image: none
            }

            :-moz-focusring {
                outline: auto
            }

            :-moz-ui-invalid {
                box-shadow: none
            }

            progress {
                vertical-align: baseline
            }

            ::-webkit-inner-spin-button,
            ::-webkit-outer-spin-button {
                height: auto
            }

            [type=search] {
                -webkit-appearance: textfield;
                outline-offset: -2px
            }

            ::-webkit-search-decoration {
                -webkit-appearance: none
            }

            ::-webkit-file-upload-button {
                -webkit-appearance: button;
                font: inherit
            }

            summary {
                display: list-item
            }

            blockquote,
            dl,
            dd,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            hr,
            figure,
            p,
            pre {
                margin: 0
            }

            fieldset {
                margin: 0;
                padding: 0
            }

            legend {
                padding: 0
            }

            ol,
            ul,
            menu {
                list-style: none;
                margin: 0;
                padding: 0
            }

            dialog {
                padding: 0
            }

            textarea {
                resize: vertical
            }

            input::-moz-placeholder,
            textarea::-moz-placeholder {
                opacity: 1;
                color: #9ca3af
            }

            input::placeholder,
            textarea::placeholder {
                opacity: 1;
                color: #9ca3af
            }

            button,
            [role=button] {
                cursor: pointer
            }

            :disabled {
                cursor: default
            }

            img,
            svg,
            video,
            canvas,
            audio,
            iframe,
            embed,
            object {
                display: block;
                vertical-align: middle
            }

            img,
            video {
                max-width: 100%;
                height: auto
            }

            [hidden]:where(:not([hidden=until-found])) {
                display: none
            }

            .absolute {
                position: absolute
            }

            .relative {
                position: relative
            }

            .-bottom-16 {
                bottom: -4rem
            }

            .-left-16 {
                left: -4rem
            }

            .-left-20 {
                left: -5rem
            }

            .top-0 {
                top: 0
            }

            .z-0 {
                z-index: 0
            }

            .\!row-span-1 {
                grid-row: span 1 / span 1 !important
            }

            .-mx-3 {
                margin-left: -.75rem;
                margin-right: -.75rem
            }

            .-ml-px {
                margin-left: -1px
            }

            .ml-3 {
                margin-left: .75rem
            }

            .mt-4 {
                margin-top: 1rem
            }

            .mt-6 {
                margin-top: 1.5rem
            }

            .flex {
                display: flex
            }

            .inline-flex {
                display: inline-flex
            }

            .table {
                display: table
            }

            .grid {
                display: grid
            }

            .\!hidden {
                display: none !important
            }

            .hidden {
                display: none
            }

            .aspect-video {
                aspect-ratio: 16 / 9
            }

            .size-12 {
                width: 3rem;
                height: 3rem
            }

            .size-5 {
                width: 1.25rem;
                height: 1.25rem
            }

            .size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .h-12 {
                height: 3rem
            }

            .h-40 {
                height: 10rem
            }

            .h-5 {
                height: 1.25rem
            }

            .h-full {
                height: 100%
            }

            .min-h-screen {
                min-height: 100vh
            }

            .w-5 {
                width: 1.25rem
            }

            .w-\[calc\(100\%_\+_8rem\)\] {
                width: calc(100% + 8rem)
            }

            .w-auto {
                width: auto
            }

            .w-full {
                width: 100%
            }

            .max-w-2xl {
                max-width: 42rem
            }

            .max-w-\[877px\] {
                max-width: 877px
            }

            .flex-1 {
                flex: 1 1 0%
            }

            .shrink-0 {
                flex-shrink: 0
            }

            .transform {
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }

            .cursor-default {
                cursor: default
            }

            .resize {
                resize: both
            }

            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .\!flex-row {
                flex-direction: row !important
            }

            .flex-col {
                flex-direction: column
            }

            .items-start {
                align-items: flex-start
            }

            .items-center {
                align-items: center
            }

            .items-stretch {
                align-items: stretch
            }

            .justify-end {
                justify-content: flex-end
            }

            .justify-center {
                justify-content: center
            }

            .justify-between {
                justify-content: space-between
            }

            .justify-items-center {
                justify-items: center
            }

            .gap-2 {
                gap: .5rem
            }

            .gap-4 {
                gap: 1rem
            }

            .gap-6 {
                gap: 1.5rem
            }

            .self-center {
                align-self: center
            }

            .overflow-hidden {
                overflow: hidden
            }

            .rounded-\[10px\] {
                border-radius: 10px
            }

            .rounded-full {
                border-radius: 9999px
            }

            .rounded-lg {
                border-radius: .5rem
            }

            .rounded-md {
                border-radius: .375rem
            }

            .rounded-sm {
                border-radius: .125rem
            }

            .rounded-l-md {
                border-top-left-radius: .375rem;
                border-bottom-left-radius: .375rem
            }

            .rounded-r-md {
                border-top-right-radius: .375rem;
                border-bottom-right-radius: .375rem
            }

            .border {
                border-width: 1px
            }

            .border-gray-300 {
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity, 1))
            }

            .bg-\[\#FF2D20\]\/10 {
                background-color: #ff2d201a
            }

            .bg-gray-50 {
                --tw-bg-opacity: 1;
                background-color: rgb(249 250 251 / var(--tw-bg-opacity, 1))
            }

            .bg-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity, 1))
            }

            .bg-gradient-to-b {
                background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
            }

            .from-transparent {
                --tw-gradient-from: transparent var(--tw-gradient-from-position);
                --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
            }

            .via-white {
                --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .to-white {
                --tw-gradient-to: #fff var(--tw-gradient-to-position)
            }

            .to-zinc-900 {
                --tw-gradient-to: #18181b var(--tw-gradient-to-position)
            }

            .stroke-\[\#FF2D20\] {
                stroke: #ff2d20
            }

            .object-cover {
                -o-object-fit: cover;
                object-fit: cover
            }

            .object-top {
                -o-object-position: top;
                object-position: top
            }

            .p-6 {
                padding: 1.5rem
            }

            .px-2 {
                padding-left: .5rem;
                padding-right: .5rem
            }

            .px-3 {
                padding-left: .75rem;
                padding-right: .75rem
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .py-10 {
                padding-top: 2.5rem;
                padding-bottom: 2.5rem
            }

            .py-16 {
                padding-top: 4rem;
                padding-bottom: 4rem
            }

            .py-2 {
                padding-top: .5rem;
                padding-bottom: .5rem
            }

            .pt-3 {
                padding-top: .75rem
            }

            .text-center {
                text-align: center
            }

            .font-sans {
                font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", Segoe UI Symbol, "Noto Color Emoji"
            }

            .text-sm {
                font-size: .875rem;
                line-height: 1.25rem
            }

            .text-sm\/relaxed {
                font-size: .875rem;
                line-height: 1.625
            }

            .text-xl {
                font-size: 1.25rem;
                line-height: 1.75rem
            }

            .font-medium {
                font-weight: 500
            }

            .font-semibold {
                font-weight: 600
            }

            .leading-5 {
                line-height: 1.25rem
            }

            .text-black {
                --tw-text-opacity: 1;
                color: rgb(0 0 0 / var(--tw-text-opacity, 1))
            }

            .text-black\/50 {
                color: #00000080
            }

            .text-gray-500 {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity, 1))
            }

            .text-gray-700 {
                --tw-text-opacity: 1;
                color: rgb(55 65 81 / var(--tw-text-opacity, 1))
            }

            .text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .underline {
                text-decoration-line: underline
            }

            .antialiased {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale
            }

            .shadow-\[0px_14px_34px_0px_rgba\(0\,0\,0\,0\.08\)\] {
                --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, .08);
                --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .shadow-sm {
                --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);
                --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .ring-black {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(0 0 0 / var(--tw-ring-opacity, 1))
            }

            .ring-gray-300 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(209 213 219 / var(--tw-ring-opacity, 1))
            }

            .ring-transparent {
                --tw-ring-color: transparent
            }

            .ring-white {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1))
            }

            .ring-white\/\[0\.05\] {
                --tw-ring-color: rgb(255 255 255 / .05)
            }

            .drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.06\)\] {
                --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, .06));
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
            }

            .drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.25\)\] {
                --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, .25));
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
            }

            .filter {
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
            }

            .transition {
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-backdrop-filter;
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
                transition-timing-function: cubic-bezier(.4, 0, .2, 1);
                transition-duration: .15s
            }

            .duration-150 {
                transition-duration: .15s
            }

            .duration-300 {
                transition-duration: .3s
            }

            .ease-in-out {
                transition-timing-function: cubic-bezier(.4, 0, .2, 1)
            }

            .selection\:bg-\[\#FF2D20\] *::-moz-selection {
                --tw-bg-opacity: 1;
                background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
            }

            .selection\:bg-\[\#FF2D20\] *::selection {
                --tw-bg-opacity: 1;
                background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
            }

            .selection\:text-white *::-moz-selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .selection\:text-white *::selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .selection\:bg-\[\#FF2D20\]::-moz-selection {
                --tw-bg-opacity: 1;
                background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
            }

            .selection\:bg-\[\#FF2D20\]::selection {
                --tw-bg-opacity: 1;
                background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
            }

            .selection\:text-white::-moz-selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .selection\:text-white::selection {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .hover\:text-black:hover {
                --tw-text-opacity: 1;
                color: rgb(0 0 0 / var(--tw-text-opacity, 1))
            }

            .hover\:text-black\/70:hover {
                color: #000000b3
            }

            .hover\:text-gray-400:hover {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity, 1))
            }

            .hover\:text-gray-500:hover {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity, 1))
            }

            .hover\:ring-black\/20:hover {
                --tw-ring-color: rgb(0 0 0 / .2)
            }

            .focus\:z-10:focus {
                z-index: 10
            }

            .focus\:border-blue-300:focus {
                --tw-border-opacity: 1;
                border-color: rgb(147 197 253 / var(--tw-border-opacity, 1))
            }

            .focus\:outline-none:focus {
                outline: 2px solid transparent;
                outline-offset: 2px
            }

            .focus\:ring:focus {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .focus-visible\:ring-1:focus-visible {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1))
            }

            .active\:bg-gray-100:active {
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity, 1))
            }

            .active\:text-gray-500:active {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity, 1))
            }

            .active\:text-gray-700:active {
                --tw-text-opacity: 1;
                color: rgb(55 65 81 / var(--tw-text-opacity, 1))
            }

            @media (min-width: 640px) {
                .sm\:flex {
                    display: flex
                }

                .sm\:hidden {
                    display: none
                }

                .sm\:size-16 {
                    width: 4rem;
                    height: 4rem
                }

                .sm\:size-6 {
                    width: 1.5rem;
                    height: 1.5rem
                }

                .sm\:flex-1 {
                    flex: 1 1 0%
                }

                .sm\:items-center {
                    align-items: center
                }

                .sm\:justify-between {
                    justify-content: space-between
                }

                .sm\:pt-5 {
                    padding-top: 1.25rem
                }
            }

            @media (min-width: 768px) {
                .md\:row-span-3 {
                    grid-row: span 3 / span 3
                }
            }

            @media (min-width: 1024px) {
                .lg\:col-start-2 {
                    grid-column-start: 2
                }

                .lg\:h-16 {
                    height: 4rem
                }

                .lg\:max-w-7xl {
                    max-width: 80rem
                }

                .lg\:grid-cols-2 {
                    grid-template-columns: repeat(2, minmax(0, 1fr))
                }

                .lg\:grid-cols-3 {
                    grid-template-columns: repeat(3, minmax(0, 1fr))
                }

                .lg\:flex-col {
                    flex-direction: column
                }

                .lg\:items-end {
                    align-items: flex-end
                }

                .lg\:justify-center {
                    justify-content: center
                }

                .lg\:gap-8 {
                    gap: 2rem
                }

                .lg\:p-10 {
                    padding: 2.5rem
                }

                .lg\:pb-10 {
                    padding-bottom: 2.5rem
                }

                .lg\:pt-0 {
                    padding-top: 0
                }

                .lg\:text-\[\#FF2D20\] {
                    --tw-text-opacity: 1;
                    color: rgb(255 45 32 / var(--tw-text-opacity, 1))
                }
            }

            .rtl\:flex-row-reverse:where([dir=rtl], [dir=rtl] *) {
                flex-direction: row-reverse
            }

            @media (prefers-color-scheme: dark) {
                .dark\:block {
                    display: block
                }

                .dark\:hidden {
                    display: none
                }

                .dark\:border-gray-600 {
                    --tw-border-opacity: 1;
                    border-color: rgb(75 85 99 / var(--tw-border-opacity, 1))
                }

                .dark\:bg-black {
                    --tw-bg-opacity: 1;
                    background-color: rgb(0 0 0 / var(--tw-bg-opacity, 1))
                }

                .dark\:bg-gray-800 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1))
                }

                .dark\:bg-zinc-900 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(24 24 27 / var(--tw-bg-opacity, 1))
                }

                .dark\:via-zinc-900 {
                    --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                    --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)
                }

                .dark\:to-zinc-900 {
                    --tw-gradient-to: #18181b var(--tw-gradient-to-position)
                }

                .dark\:text-gray-300 {
                    --tw-text-opacity: 1;
                    color: rgb(209 213 219 / var(--tw-text-opacity, 1))
                }

                .dark\:text-gray-400 {
                    --tw-text-opacity: 1;
                    color: rgb(156 163 175 / var(--tw-text-opacity, 1))
                }

                .dark\:text-gray-600 {
                    --tw-text-opacity: 1;
                    color: rgb(75 85 99 / var(--tw-text-opacity, 1))
                }

                .dark\:text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity, 1))
                }

                .dark\:text-white\/50 {
                    color: #ffffff80
                }

                .dark\:text-white\/70 {
                    color: #ffffffb3
                }

                .dark\:ring-zinc-800 {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity, 1))
                }

                .dark\:hover\:text-gray-300:hover {
                    --tw-text-opacity: 1;
                    color: rgb(209 213 219 / var(--tw-text-opacity, 1))
                }

                .dark\:hover\:text-white:hover {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity, 1))
                }

                .dark\:hover\:text-white\/70:hover {
                    color: #ffffffb3
                }

                .dark\:hover\:text-white\/80:hover {
                    color: #fffc
                }

                .dark\:hover\:ring-zinc-700:hover {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity, 1))
                }

                .dark\:focus\:border-blue-700:focus {
                    --tw-border-opacity: 1;
                    border-color: rgb(29 78 216 / var(--tw-border-opacity, 1))
                }

                .dark\:focus\:border-blue-800:focus {
                    --tw-border-opacity: 1;
                    border-color: rgb(30 64 175 / var(--tw-border-opacity, 1))
                }

                .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1))
                }

                .dark\:focus-visible\:ring-white:focus-visible {
                    --tw-ring-opacity: 1;
                    --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1))
                }

                .dark\:active\:bg-gray-700:active {
                    --tw-bg-opacity: 1;
                    background-color: rgb(55 65 81 / var(--tw-bg-opacity, 1))
                }

                .dark\:active\:text-gray-300:active {
                    --tw-text-opacity: 1;
                    color: rgb(209 213 219 / var(--tw-text-opacity, 1))
                }
            }
        </style>
    @endif
</head>

<body>
    @include('layouts.navigation')

    {{-- Greetings Section --}}
    <div class="w-full h-screen bg-neutral-900 flex justify-center items-center">
        <div
            class="flex flex-col absolute justify-center items-center text-white text-center gap-2 sm:gap-4 mx-auto z-20">
            @auth
                <h1 class="sm:text-5xl text-2xl font-bold">Welcome, <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-sky-700 via-purple-700 to-pink-600">{{ Auth::user()->name }}</span>
                </h1>
            @else
                <h1 class="sm:text-5xl text-2xl font-bold">Welcome, <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-sky-700 via-purple-700 to-pink-600">Anonymous</span>
                </h1>
            @endauth
        </div>
        <img class="w-full h-screen object-cover opacity-40" src="https://media.istockphoto.com/id/458971457/photo/film-releases.jpg?s=612x612&w=0&k=20&c=pRYhzYx7Hbt_OxSYRvuR00-ulfzs85KJo4QDnrGMS8g=" alt="">
        <div class="h-screen bg-gradient-to-t from-neutral-900 to-transparent absolute inset-0 z-10"></div>
    </div>

    {{-- Latest Movie Section --}}
    <div class="dark:bg-neutral-900 w-full h-auto flex flex-col relative items-center justify-center">
        <h1 data-aos="fade-down" class="md:text-5xl text-2xl font-bold text-white relative top-0 mt-6 md:my-4">
            Latest Movie
        </h1>

        <div data-aos="fade-left" id="card-group" class="swiper w-full h-max flex justify-center items-center py-10">
            <div class="swiper-wrapper">
                @foreach ($latestFilm as $ltFilm)
                    <div class="swiper-slide flex justify-center items-center w-48 md:min-w-64 h-full transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                        <a href="{{ route('films.show', $ltFilm->id) }}" id="card"
                            class="flex flex-col items-center snap-center justify-center relative group ">
                            <img class="h-80 w-full md:h-96 rounded-lg object-cover" src="{{ $ltFilm->poster }}"
                                alt="{{ $ltFilm->title }}">
                            <div class="flex flex-col w-full p-2">
                                <h2 class="text-white text-left font-semibold w-full">{{ $ltFilm->title }}</h2>
                                <div class="flex items-center w-full justify-between">
                                    <h4 class="text-white font-thin">{{ $ltFilm->release_year }}</h4>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-blue-400">
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                        <h4 class="text-white font-thin">{{ $averageRatings[$ltFilm->id] ?? 0 }}/5</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    {{-- Movie List Section --}}
    <div class="bg-neutral-900 w-full h-auto flex flex-col items-center relative justify-center">
        <h1 data-aos="fade-up" class="sm:text-5xl text-2xl font-bold text-white my-2">Movie List</h1>
        <div class="flex flex-row md:w-1/2 w-3/4 justify-center items-center gap-2 md:gap-4">
            <form class="block md:w-full w-2/3" action="{{ route('films.search-in-landing-page') }}">
                @csrf
                <div class="relative">
                    <x-text-input id="title" class="pl-10 w-full text-xs md:text-base" type="text" name="title"
                        :value="old('title')" required placeholder="Type title you want here.." />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </form>
            <div class="block md:w-1/2 w-max">
                <a href="{{ route('films.search') }}"
                    class="p-2 bg-green-600 rounded-md flex justify-center items-center flex-row gap-2 text-white">
                    <h3 class="md:text-base text-xs hidden md:block">See more</h3>
                    <i class="fas fa-arrow-right md:text-base text-xs"></i>
                </a>
            </div>
        </div>
        @if ($errors->any())
            <div class="mt-4 px-4 py-2 w-full bg-red-500 text-white rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="card-group" class="w-full h-full flex flex-wrap flex-row justify-center p-4 mt-10 relative gap-x-4 gap-y-6">
            @foreach ($listFilm as $lf)
                <a href="{{ route('films.show', $lf->id) }}" data-aos="zoom-in-right" id="card"
                    class="group flex flex-col items-center justify-center relative w-48 lg:min-w-64 h-full">
                    <div class="transform transition-transform duration-300 hover:scale-110 hover:text-blue-400">
                        <img src="{{ $lf->poster }}" alt="{{ $lf->title }}" class="h-80 w-full md:h-96 rounded-lg object-cover">
                        <div class="flex flex-col w-full p-2">
                            <h2 class="text-white text-left font-semibold w-full">{{ $lf->title }}</h2>
                            <div class="flex items-center w-full justify-between">
                                <h4 class="text-white font-thin">{{ $lf->release_year }}</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-blue-400">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                    <h4 class="text-white font-thin">{{ $averageRatings[$lf->id] ?? 0 }}/5</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Genre Section
    <div class="bg-neutral-900 w-full h-screen justify-center items-end flex">
        <div class="w-full grid grid-cols-2 md:grid-cols-3 gap-4 p-4">
            @foreach ($genreCard as $gc)
                <a href="" data-aos="zoom-in"
                    class="bg-neutral-800 md:h-40 h-20 rounded-lg flex justify-center items-center">
                    <h1 class="text-white text-center font-bold text-xl">{{ $gc->title }}</h1>
                </a>
            @endforeach
        </div>
    </div> --}}

    {{-- Footer Section --}}
    <footer class="bg-neutral-900 w-full h-1/3 flex flex-col items-center relative justify-center p-4">
        <div
            class="border border-neutral-700 w-full flex h-full items-center justify-center mb-10 border-r-0 border-l-0 p-10 ">
            <div class=" flex justify-between w-full items-center">
                <div class="flex flex-col-reverse md:flex-row items-start md:items-center justify-between w-3/5">
                    <h1 class="text-neutral-700 text-xs md:text-sm">&copy; {{ date('Y') }} <span
                            class="font-semibold">{{ config('app.name', 'Laravel') }}</span> All rights reserved.</h1>
                    <x-application-logo class="w-20 md:w-64 h-auto" />
                </div>
                <div class="flex gap-2">
                    <i class="fa-brands fa-instagram text-neutral-700 bg-white p-2 rounded-full"></i>
                    <i class="fa-brands fa-youtube text-neutral-700 bg-white p-2 rounded-full"></i>
                    <i class="fa-brands fa-facebook text-neutral-700 bg-white p-2 rounded-full"></i>
                </div>
            </div>
        </div>
    </footer>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let stars = document.querySelectorAll(".star");
        let ratingInput = document.getElementById("rating");

        if (stars.length > 0) { // Pastikan elemen ada sebelum diproses
            stars.forEach(star => {
                star.addEventListener("click", function() {
                    let rating = this.getAttribute("data-value");
                    ratingInput.value = rating;

                    stars.forEach(s => {
                        s.classList.toggle("text-yellow-400", s.getAttribute(
                            "data-value") <= rating);
                        s.classList.toggle("text-gray-400", s.getAttribute(
                            "data-value") > rating);
                    });
                });
            });

            let savedRating = ratingInput.value;
            if (savedRating > 0) {
                stars.forEach(s => {
                    s.classList.toggle("text-yellow-400", s.getAttribute("data-value") <= savedRating);
                    s.classList.toggle("text-gray-400", s.getAttribute("data-value") > savedRating);
                });
            }
        }
    });

    const swiper = new Swiper('.swiper', {
        slidesPerView: "auto",
        spaceBetween: 20,
        loop: true,
        centeredSlides: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

</html>
