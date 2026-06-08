# Library Page Frontend Feature Documentation

This document describes all the frontend features, structure, fields, filters, and components of the **Knowledge Library (`/library`)** page. It serves as a guide for linking this page to a dynamic database and Laravel backend.

---

## 1. Page Header (Site-Wide Layout)
- **Brand / Logo**:
  - **Logo Icon**: Brain vector SVG icon.
  - **Main Brand Name**: `LIFE DECODE` (Stylized text, `LIFE` in white, `DECODE` in primary yellow/gold).
  - **Subtitle / Tagline**: `Decode life. Live amplified.`
- **Primary Navigation**:
  - Links: `Home`, `Library` (Active state, styled with gold bottom border), `Blog`, `Tools`, `Community`, `About`.
- **Header Actions**:
  - **Search Button**: Toggle search icon.
  - **Theme Toggle Pill**: Sun/Moon capsule theme switch (`☼ ☾` visual capsule toggle).
  - **CTA Button**: `The Mental Toolkit` primary yellow button with a download icon.

---

## 2. Hero Section
- **Breadcrumb**: `Library / Episodes`
- **Main Heading**: `Your Knowledge Library`
- **Description**: `Explore all episodes, deep dives, and resources to understand the mind, decode behavior, and upgrade your life.`
- **Stats Counters**:
  - **Videos**: Total count (Mockup: `112`), label: `Videos` / subtitle: `In-depth lessons` (Icon: Play circle SVG).
  - **Articles**: Total count (Mockup: `78`), label: `Articles` / subtitle: `Deep dive insights` (Icon: Document text SVG).
  - **Resources**: Total count (Mockup: `36`), label: `Resources` / subtitle: `Worksheets & guides` (Icon: Download arrow SVG).
  - **Topics**: Total count (Mockup: `15`), label: `Topics` / subtitle: `Areas to explore` (Icon: Brain SVG).

---

## 3. Search & Filter Bar
- **Search Input Form**:
  - **Text Field**: Input field with placeholder `"Search episodes, topics, or keywords..."`.
  - **Submit Button**: Magnifying glass search icon with black square background.
- **Filter Dropdown Pills**:
  - `All Content ˅` (Content type filter dropdown)
  - `All Topics ˅` (Topic category filter dropdown)
  - `All Formats ˅` (Format/Duration/Length filter dropdown)
  - `Sort: Newest ˅` (Sorting option dropdown)
- **Reset Button**:
  - Button with text `↻ Reset` to clear all search terms and filter criteria.

---

## 4. Left Sidebar (Filter Pane)
- **Filter by Type**:
  - Lists content types with total counts:
    - `All Content` (Mockup: `226`)
    - `Videos` (Mockup: `112`)
    - `Articles / Deep Dives` (Mockup: `78`)
    - `Resources` (Mockup: `36`)
  - Interactivity: Selection highlights the active line with a light gold background.
- **Duration (Videos)**:
  - Radio-button style circles for filtering video length:
    - `All Durations` (Selected by default)
    - `0 - 10 min`
    - `10 - 20 min`
    - `20 - 40 min`
    - `40+ min`
- **Difficulty Level**:
  - Checkbox list for experience level filtering:
    - `Beginner`
    - `Intermediate`
    - `Advanced`
- **Clear Button**:
  - `× Clear All Filters` button to reset the left pane settings.

---

## 5. Main Content Area (Resource Grid)
- **Metadata Summary**:
  - Result count label: e.g. `226 Results Found`.
  - **View Toggle**: Grid view icon (`▦`) and List view icon (`☷`).
- **Resource Cards Grid**:
  - Each card represents an episode, article, or downloadable resource.
  - **Thumbnail Image**:
    - Video cards display a duration stamp (e.g. `18:45`) and a play overlay icon `▶`.
  - **Card Content**:
    - **Type Badge**: Colored indicators:
      - `VIDEO` (Light Blue/Blue background & text)
      - `ARTICLE` (Light Green/Green background & text)
      - `RESOURCE` (Light Purple/Purple background & text)
    - **Title**: Clickable title linking to the detail page.
    - **Tags**: Topic-based tag pills (e.g. `Cognitive Biases`, `Psychology`).
    - **Card Footer**:
      - Publication Date (e.g. `May 15, 2024`).
      - Estimated time/length (e.g. `18 min`, `12 min read`, `PDF`).
      - **Action Icon**:
        - Bookmark ribbon icon for Videos/Articles.
        - Download arrow icon for Resources.
- **Suggest Topic Strip**:
  - Text: `Can't find what you're looking for? Use search or browse topics to explore more insights.`
  - Action Button: `Suggest a Topic` button.

---

## 6. Right Sidebar (Browse & CTA Pane)
- **Browse by Topic Card**:
  - Heading: `Browse by Topic` with a link `View All Topics →`.
  - A vertical list of topics with icons and counts:
    - 🧠 `Cognitive Biases (24)` (Yellow brain icon)
    - 👤 `Mindset (18)` (Blue silhouette icon)
    - 🔑 `Mental Models (16)` (Blue lock/key icon)
    - 📈 `Productivity (19)` (Green chart/arrow icon)
    - 👥 `Human Behavior (22)` (Purple profile icon)
    - 🏛️ `Philosophy (15)` (Orange column icon)
    - 🧠 `Neuroscience (12)` (Blue brain icon)
    - 📄 `Case Studies (10)` (Green page icon)
    - ❤️ `Emotional Intelligence (8)` (Red heart icon)
    - 💬 `Communication (9)` (Green bubble icon)
    - 📅 `Habits (12)` (Green calendar icon)
    - ⭐ `Self Improvement (14)` (Yellow star icon)
    - 💡 `Creativity (7)` (Yellow bulb icon)
    - 🎯 `Purpose & Meaning (6)` (Red target icon)
    - 💗 `Relationships (8)` (Pink heart icon)
- **Resource Center CTA Card**:
  - Heading: `Resource Center`.
  - Subtext: `Download practical tools and worksheets to apply what you learn.`
  - Button: `Explore Resources →` (Orange outline style).
  - Graphic: SVG sketch showing notebook/pencil document layers.
- **Stay Updated Newsletter Card**:
  - Heading: `Stay Updated`.
  - Subtext: `Get new insights and resources straight to your inbox.`
  - Form: Email address input field and `Subscribe` button.
  - Social Proof Footer:
    - Text: `Join 25,000+ learners`
    - Overlapping circular face avatars representing community members.

---

## 7. Dynamic Data Model Plan (Future Steps)
To make this page dynamic, the following elements should be integrated with backend routes and models:
1. **Episodes/Articles/Resources Database Model**:
   - Fields: `title`, `slug`, `type` (video/article/resource), `duration_seconds`, `read_time_minutes`, `publish_date`, `thumbnail_path`, `file_path` (for resources).
2. **Topics/Tags Relationship**:
   - A many-to-many relationship mapping topics/tags to articles/episodes.
   - Topics database table with columns: `name`, `slug`, `icon_type` (for theme selection), `color_code`.
3. **Filter and Search Controller Queries**:
   - Bind search bar inputs to `LIKE %query%` SQL conditions.
   - Map sidebar checkboxes (difficulty, duration range, content types) to dynamic Eloquent `where` query scopes.
4. **Subscriber Form**:
   - Create a POST endpoint `/newsletter/subscribe` storing subscriber emails in database and queuing welcome emails.
5. **View Mode State**:
   - Use local storage or state parameters to maintain `grid` vs `list` layout mode.

---

## 8. Client-Side JavaScript Filtering & Selector Reference
To ensure reliable operation without conflicts, the client-side JavaScript uses the following class hooks and conventions:
- **Search Form (`.library-search`)**: Prevents default form submission on submit to allow inline JavaScript search functionality.
- **Search Input (`.library-search input`)**: Binds to the `input` event for live updates.
- **Content Type Filters (`[data-filter-type]`)**: Toggles the active content category.
- **Duration Filters (`[data-filter-duration]`)**: Binds to duration ranges. The visual radio-dot highlights on click.
- **Difficulty Filters (`[data-filter-difficulty]`)**: Multiple levels can be checked. Highlights are managed via the `.checked` class toggle.
- **Reset Button (`.reset-filters-btn`)**: Clears search inputs, checkboxes, active category, and resets counts to original.
- **Clear Sidebar Button (`.clear-filters-btn`)**: Clears sidebar checks and input queries, calling `resetAll()`.
- **View Toggle Buttons (`.grid-toggle` & `.list-toggle`)**: Add/remove `.list-view` class on the `.content-grid-library` container.
  - *Note*: Cards are hidden by toggling `display = 'none'` and shown by setting `display = ''` to prevent overriding the grid/list CSS display styles.

