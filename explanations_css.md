# CSS, Flexbox and Grid Explanations

All site styling lives in `assets/css/styles.css`.

## Font import and design tokens

The `@import` requests DM Sans for body copy and Manrope for headings. `:root` custom properties define the navy, blue, teal, gold, cream and utility colours, plus one reusable shadow. Central variables keep the interface consistent and make rebranding easy.

## Reset and base styles

The universal selector applies predictable `border-box` sizing. Base rules remove default body spacing, establish typography and make images responsive. Headings share a compact line height. Buttons and inputs inherit the site font. `.container` creates a capped, fluid page width.

## Accessibility helpers

The skip link sits above the viewport until keyboard focus moves it into view. Focused inputs receive both a coloured border and visible outer ring. The reduced-motion media query disables smooth scrolling and transitions, while JavaScript separately stops ticker animation.

## Header and navigation Flexbox

`.navbar`, `.brand` and `.nav-links` use Flexbox because their items form one-dimensional rows. Sticky positioning keeps navigation available. Active and hover states use teal, while registration uses a filled treatment. Below 900px the button appears and the list becomes an absolutely positioned dropdown; JavaScript adds `.open`.

## Hero CSS Grid

`.hero-grid` uses two columns for copy and the image showcase. The dark background, large display heading, gold accent and subtle circular decoration establish the visual identity. Flexbox arranges button and statistic rows. The slider uses absolute positioning for its overlay and controls because those elements sit over the image.

## Ticker

The ticker is a clipped Flexbox row. Its fixed label remains stationary while the paragraph’s transform is controlled by JavaScript. `white-space: nowrap` keeps the announcement on one moving line.

## Reusable sections and cards

`.section` supplies consistent vertical rhythm. `.section-heading` uses Flexbox to separate title and context. Member, value, service and popup collections use CSS Grid: four columns for members/values, three for services/pop-ups. Cards use whitespace, borders and subtle colour changes instead of excessive decoration.

Profile images use a consistent aspect ratio and `object-fit`. A small hover scale adds feedback. Service cards share one outer border, while internal borders separate columns.

## Page-specific layouts

`.page-hero` creates the shared internal-page banner. `.story-grid` and `.contact-grid` use asymmetric Grid columns. `.callout` uses Flexbox because it aligns two items. The contact panel uses teal to contrast with the white form card.

## Forms

`.form-grid` provides two equal columns, while `.full` spans both. Labels are small and strong; controls are large enough for touch. `.auth-section` uses Grid for its branded and form halves. The form itself uses a one-column Grid. Alerts and toast messages use colour plus borders, not colour alone.

## Dashboard

The dashboard heading and table header use Flexbox. Summary cards use a three-column Grid. The table wrapper enables horizontal scrolling on small screens. Table headers are visually distinct, record sub-details use block-level small text, and status pills receive status-specific colours. Action controls remain compact while retaining clear labels.

## Footer

The footer uses a three-column Grid on dark navy. Its brand stays visible in white, and the copyright row is separated by a low-contrast border.

## Responsive rules

At 900px, complex two-column layouts collapse, member/value grids become two columns, and services/pop-ups become one column. At 620px, containers narrow slightly, all remaining card and form grids become one column, large headings scale down, and headings/callouts/dashboard controls switch to vertical Flexbox. These rules allow the same markup to work on desktop, tablet and mobile.
