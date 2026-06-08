# Blog Page — Frontend Documentation

**Route:** `/blog`  
**View file:** `resources/views/life-decode/blog.blade.php`  
**Layout:** `resources/views/life-decode/layout.blade.php`

---

## 1. Page Overview

The Blog page is a content-focused publishing hub for **Life Decode**. It features a hero banner with search, category tab navigation, a featured post section, a paginated article listing, and a rich sidebar (about, topics, popular posts, newsletter). It supports **Dark Mode** and **client-side filtering** without any backend round-trips.

---

## 2. Layout Sections

### 2.1 Hero (`page-hero blog-hero`)
- Full-width dark atmospheric banner
- Title, lead text, and a search input (`blog-search-form` / `blog-search-input`)
- Background: deep dark gradient (`#020815 → #061426`) with the `life-decode-hero.png` overlay

### 2.2 Category Tab Nav (`.blog-tabs`)
- Horizontal scrollable tab list
- 8 categories with colored SVG icons:
  - All Posts (grid icon)
  - Cognitive Biases (brain icon, yellow)
  - Mindset (person icon, orange)
  - Mental Models (wrench icon, purple)
  - Productivity (clock icon, green)
  - Human Behavior (group icon, pink)
  - Philosophy (columns icon, orange)
  - Case Studies (doc icon, lime)
- Active tab: gold underline border (`--gold`)
- Data attribute: `data-category` used by JS for filtering

### 2.3 Blog Main Layout (`.blog-layout`)
- CSS grid: `1fr 310px` (main + sidebar)
- Collapses to `1fr` on `≤ 1050px` (tablet)

#### Featured Post (`.featured-post`)
- Grid: `1.08fr 0.8fr`
- Left: Atmospheric dark illustration panel (CSS-drawn + SVG figure)
- Right: Category label, H2 title, body copy, date/read time, "Read More" link

#### Article Listing (`.article-listing`)
- Articles displayed as rows (`.article-row`)
- Grid: `160px 1fr 20px` (thumbnail | content | bookmark icon)
- Hover state: subtle `#fafbfc` highlight (`.article-row:hover`)
- Each row has:
  - Colored thumbnail (`.article-thumb` + image class)
  - UPPERCASE colored category label (`.overline`)
  - H3 title (16px, font-weight 900)
  - Short description paragraph
  - Meta line (date · read time)
  - Bookmark SVG button (`.bookmark-btn`, toggles `.bookmarked`)

#### Pagination (`.pagination`)
- Rendered dynamically by JS (`renderPagination()`)
- Items per page: **4**
- Uses `page-pill` / `page-pill active` / `page-pill disabled` classes

---

## 3. Sidebar (`.blog-side`)

All sidebar cards use `.side-card` class.

### 3.1 About Card
- Brief description + "Join the Community" CTA button

### 3.2 Popular Topics (`.topic-list`)
- 7 topics with colored SVG icons, topic name, and a count pill (`.count-pill`)
- Hover: gold background tint (`rgba(255,187,46,0.08)`)
- Click: fires matching `.blog-tabs a` click (scrolls to tabs)
- Uses `data-sidebar-topic` attribute for JS binding

### 3.3 Popular Posts (`.event-list`)
- 3 mini posts (`.mini-post`)
- Each: thumbnail (`.mini-thumb` with image class) + bold title + date

### 3.4 Newsletter Card
- Email input + Subscribe button
- Avatar row: 4 stacked letter avatars + "Join 25,000+ readers" label

---

## 4. Dark Mode

Dark mode is toggled globally via the **theme capsule button** in the navbar (`.theme-toggle`).

### How It Works
- Theme JS lives in **`layout.blade.php`** (global, runs on every page)
- Key stored in `localStorage` as **`'ld-theme'`** (`'dark'` or `'light'`)
- On toggle: adds/removes `.dark-mode` class on `<body>`
- Theme persists across all pages (library, blog, community, etc.)

### Blog-specific dark mode CSS (in `layout.blade.php`)
| Element | Dark Style |
|---|---|
| `.featured-post` | `#0d1b2a` bg, white border |
| `.article-listing` | `#0d1b2a` bg |
| `.article-row` | border `rgba(255,255,255,.1)` |
| `.article-row h3` | `#fff` |
| `.article-row p` | `#9ca3af` |
| `.article-row:hover` | `rgba(255,255,255,.04)` |
| `.blog-tabs a` | `#9ca3af` |
| `.blog-tabs a.active` | gold color + gold border |
| `.page-pill` | `#0d1b2a` bg |
| `.page-pill.active` | gold bg |
| `.side-card` | `#0d1b2a` bg |
| `.side-card input` | `#111f30` bg |
| `.topic-line:hover` | gold tint |
| `.section-title` | `#fff` |
| `.link-blue` | `#60a5fa` |

---

## 5. Client-Side JavaScript

All interaction is handled in a self-invoking function (`(() => { ... })()`).

### State Variables
| Variable | Default | Description |
|---|---|---|
| `activeCategory` | `'all'` | Current tab filter |
| `searchQuery` | `''` | Lowercased search text |
| `currentPage` | `1` | Pagination page |
| `postsPerPage` | `4` | Items per page |

### Key Functions

#### `updateBlogFilters()`
1. Loops through all `.article-row` elements
2. Matches `data-category` and `data-title`/`data-copy` against active filters
3. Hides/shows articles using `article.style.display`
4. Shows/hides featured section when filters are active
5. Updates `.blog-results-heading` text with count
6. Calls `renderPagination(totalPages)`

#### `renderPagination(totalPages)`
- Clears `.pagination` container and rebuilds it dynamically
- Creates Prev / numbered pages / Next links
- Adds `.active` and `.disabled` classes correctly

### Event Bindings
| Selector | Event | Action |
|---|---|---|
| `.blog-tabs a` | `click` | Set `activeCategory`, reset page, update |
| `[data-sidebar-topic]` | `click` | Find matching tab and click it |
| `.blog-search-form` | `submit` | Prevent default |
| `.blog-search-input` | `input` | Set `searchQuery`, reset page, update |
| `.bookmark-btn` | `click` | Toggle `.bookmarked` class |

### Data Attributes on `.article-row`
| Attribute | Example Value |
|---|---|
| `data-category` | `"cognitive biases"` |
| `data-title` | `"10 cognitive biases..."` (lowercased) |
| `data-copy` | `"understand the hidden..."` (lowercased) |

---

## 6. Thumbnail Image Classes

| Class | Background |
|---|---|
| `bias-img` | `about-creator.png` overlay |
| `mindset-img` | Brown/warm gradient |
| `human-img` | `life-decode-hero.png` overlay |
| `desk-img` | `about-desk.png` overlay |
| `philosophy-img` | Dark sepia gradient |
| `case-img` | Gray gradient + gold radial |
| `halo-img` (mini) | `about-creator.png` |
| `ras-img` (mini) | `life-decode-hero.png` |
| `overthink-img` (mini) | `about-desk.png` |

---

## 7. Mobile Responsiveness

Responsive breakpoints defined in `layout.blade.php`:

| Breakpoint | Change |
|---|---|
| `≤ 1050px` | `.blog-layout` → `1fr`, `.featured-post` → `1fr`, nav hidden (hamburger) |
| `≤ 768px` | article-row stacks, hero font shrinks, tabs scroll horizontally |

Blog tabs (`.blog-tabs`) use `overflow-x: auto` for horizontal scroll on mobile.

---

## 8. Future Dynamic Integration

To connect blog to a real backend:

1. **`Post` Eloquent Model** — fields: `title`, `slug`, `category`, `excerpt`, `content`, `thumb_type`, `published_at`, `read_time`
2. **`PostController@index`** — accepts `?category=` and `?q=` query params for server-side filtering
3. **Blade loop** — replace static `@foreach` with `@foreach($posts as $post)` (paginated via `$posts->links()`)
4. **Category taxonomy** — `Category` model or enum, used for tabs and sidebar topics
5. **Bookmarks** — `user_bookmarks` pivot table with localStorage fallback for guests

---

## 9. Key CSS Classes Reference

| Class | Purpose |
|---|---|
| `.blog-hero` | Hero section with dark background image |
| `.blog-search-form` | Search input container |
| `.blog-search-input` | Search `<input type="search">` |
| `.blog-tabs` | Horizontal category nav |
| `.blog-layout` | Main 2-column grid |
| `.featured-post` | Featured article card (image + copy) |
| `.article-listing` | Container for article rows |
| `.article-row` | Single article (thumb + content + bookmark) |
| `.article-thumb` | Thumbnail image box (gradient or photo) |
| `.blog-side` | Right sidebar grid |
| `.side-card` | Individual sidebar card |
| `.topic-line` | Topic item in Popular Topics |
| `.mini-post` | Item in Popular Posts sidebar |
| `.mini-thumb` | Small thumbnail in Popular Posts |
| `.pagination` | Pagination pill row |
| `.page-pill` | Individual page button |
| `.bookmark-btn` | Bookmark SVG icon (togglable) |
| `.overline` | Colored category label (uppercase, small) |
