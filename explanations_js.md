# JavaScript Code Explanations

All JavaScript is contained in `assets/js/main.js`. The script uses strict mode and is loaded with `defer`, so the document is parsed before queries run.

## Mobile navigation

The script looks for the menu button and list. A click converts the current string value of `aria-expanded` to a Boolean, writes the opposite state and toggles the `open` class. The existence check lets the same file run safely on all pages.

## Current year

`querySelectorAll` finds every `data-current-year` element. `forEach` inserts the browser’s current year, keeping the footer current without PHP configuration.

## Scrolling homepage text

The ticker paragraph is selected by `data-scrolling-text`. If the visitor has not requested reduced motion, its starting x-position is the window width. `moveTicker()` subtracts one pixel per animation frame, resets after the text leaves the left edge, and applies a CSS transform. `requestAnimationFrame` synchronizes movement with browser painting and is more efficient than a rapid timer.

## Five-image swap

The slider block contains exactly five arrays. Each inner array stores an SVG path, visible caption and accessible alternative text. `current` tracks the active index. `showSlide()` wraps negative or excessive indexes with modulo arithmetic, fades the image, then updates its source, alt text, counter and caption.

`startTimer()` resets an interval that advances every five seconds. Previous and Next buttons change the index and restart the timer so an automatic transition does not immediately override a manual choice.

## Three pop-ups

Every `data-popup` button receives a listener. For `alert`, the browser displays a message and the result region notes acknowledgement. `confirm` returns a Boolean and reports OK or Cancel. `prompt` returns text or `null`; the script distinguishes cancellation from an empty answer. `textContent` is used so visitor input can never become HTML.

## Record table search

When the search input exists, its `input` event reads a lower-case query. Each table row’s text is also lower-cased. The standard `includes` method controls the row’s `hidden` property, providing immediate client-side filtering without changing the database.

## Delete confirmation

Every delete form is intercepted just before submission. If `window.confirm` returns false, `preventDefault()` stops the POST. Server-side authentication and CSRF validation still protect the endpoint because client-side JavaScript can be bypassed.
