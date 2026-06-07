<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Life Decode - Decode life. Live amplified.')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=The+Nautigal:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #06111f;
            --ink-soft: #0a1d32;
            --line: rgba(255, 255, 255, .14);
            --muted: #5c6675;
            --gold: #ffbb2e;
            --blue: #0b63ce;
            --paper: #f7f9fc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            overflow-x: hidden;
            background: var(--paper);
            color: #111827;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.55;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .shell {
            width: min(1180px, calc(100% - 48px));
            margin: 0 auto;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(4, 12, 24, .9);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(18px);
        }

        .nav {
            display: flex;
            min-height: 74px;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: max-content;
        }

        .brand-mark {
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border: 2px solid rgba(255, 255, 255, .9);
            border-radius: 50%;
            color: #fff;
            font-weight: 900;
        }

        .brand strong {
            display: block;
            color: #fff;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 0;
            line-height: 1;
        }

        .brand strong span,
        .gold {
            color: var(--gold);
        }

        .brand small {
            display: block;
            margin-top: 4px;
            color: rgba(255, 255, 255, .72);
            font-size: 12px;
            font-weight: 500;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            color: rgba(255, 255, 255, .86);
            font-size: 14px;
            font-weight: 700;
        }

        .nav-links a {
            position: relative;
            padding: 28px 0;
        }

        .nav-links a.active {
            color: var(--gold);
        }

        .nav-links a.active::after {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 3px;
            background: var(--gold);
            content: "";
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .icon-btn {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            border: 0;
            background: transparent;
            color: #fff;
        }

        .btn {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid transparent;
            border-radius: 7px;
            padding: 0 22px;
            font-size: 14px;
            font-weight: 800;
            white-space: nowrap;
            transition: transform .2s ease, background .2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(180deg, #ffc449, var(--gold));
            color: #08111d;
            box-shadow: 0 12px 26px rgba(255, 187, 46, .22);
        }

        .btn-dark {
            border-color: rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .04);
            color: #fff;
        }

        .link-blue {
            color: var(--blue);
            font-size: 13px;
            font-weight: 800;
        }

        .page-hero {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 72% 18%, rgba(255, 187, 46, .14), transparent 34%),
                linear-gradient(135deg, #020815, #061426 54%, #020814);
            color: #fff;
        }

        .about-hero {
            display: grid;
            grid-template-columns: .95fr 1.05fr;
            min-height: 390px;
            align-items: center;
            gap: 40px;
            padding: 42px 0 0;
        }

        .eyebrow {
            margin-bottom: 14px;
            color: var(--gold);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .page-hero h1 {
            max-width: 560px;
            font-size: clamp(42px, 4vw, 58px);
            font-weight: 900;
            letter-spacing: 0;
            line-height: 1.08;
        }

        .lead {
            max-width: 560px;
            margin-top: 18px;
            color: rgba(255, 255, 255, .82);
            font-size: 16px;
            line-height: 1.8;
        }

        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            max-width: 620px;
            margin-top: 30px;
            background: rgba(255, 255, 255, .14);
        }

        .hero-metric {
            min-height: 110px;
            padding: 0 18px 0 0;
            background: #061426;
        }

        .hero-metric svg {
            color: var(--gold);
            margin-bottom: 8px;
        }

        .hero-metric b {
            display: block;
            font-size: 22px;
            line-height: 1;
        }

        .hero-metric span {
            color: rgba(255, 255, 255, .78);
            font-size: 12px;
            font-weight: 700;
        }

        .about-hero-art {
            align-self: stretch;
            min-height: 390px;
            background: url('/images/about-creator.png') center right / cover no-repeat;
            mask-image: linear-gradient(90deg, transparent, #000 18%);
        }

        .section {
            padding: 42px 0;
        }

        .split {
            display: grid;
            grid-template-columns: 1fr 1fr 270px;
            gap: 34px;
            align-items: start;
        }

        .section-title {
            margin-bottom: 16px;
            color: #111827;
            font-size: 24px;
            font-weight: 900;
        }

        .section-title::after {
            display: block;
            width: 32px;
            height: 2px;
            margin-top: 9px;
            background: var(--gold);
            content: "";
        }

        .copy {
            color: #344054;
            font-size: 15px;
            line-height: 1.8;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 26px;
            margin-top: 28px;
        }

        .mini-card {
            display: grid;
            grid-template-columns: 48px 1fr;
            gap: 15px;
            align-items: start;
        }

        .round-icon {
            display: grid;
            width: 46px;
            height: 46px;
            place-items: center;
            border: 1px solid #e1e8f0;
            border-radius: 50%;
            background: #fff;
            color: var(--blue);
            box-shadow: 0 12px 28px rgba(15, 23, 42, .06);
        }

        .round-icon.gold-icon {
            color: var(--gold);
        }

        .mini-card b {
            display: block;
            margin-bottom: 4px;
            font-size: 14px;
            font-weight: 900;
        }

        .mini-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .signature {
            margin-top: 22px;
            font-family: "The Nautigal", cursive;
            font-size: 42px;
            line-height: 1;
        }

        .creator-photo {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .12);
        }

        .creator-photo img {
            width: 100%;
            height: 312px;
            object-fit: cover;
        }

        .approach {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 46px;
            align-items: center;
            padding: 34px;
            border-radius: 8px;
            background: linear-gradient(100deg, #edf7ff, #f8fbff 48%, #eaf3ff);
        }

        .check-list {
            display: grid;
            gap: 10px;
            margin-top: 18px;
            color: #344054;
            font-size: 14px;
            font-weight: 600;
        }

        .check-list span::before {
            margin-right: 9px;
            color: var(--blue);
            content: "✓";
        }

        .process {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .process-card {
            min-height: 212px;
            padding: 30px 24px;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            background: #fff;
            text-align: center;
            box-shadow: 0 16px 38px rgba(15, 23, 42, .06);
        }

        .process-card .round-icon {
            margin: 0 auto 20px;
        }

        .process-card h3 {
            margin-bottom: 12px;
            font-size: 18px;
            font-weight: 900;
        }

        .process-card p {
            color: var(--muted);
            font-size: 14px;
        }

        .center-head {
            margin-bottom: 26px;
            text-align: center;
        }

        .center-head h2 {
            font-size: 24px;
            font-weight: 900;
        }

        .center-head h2::after {
            display: block;
            width: 34px;
            height: 2px;
            margin: 10px auto 0;
            background: var(--gold);
            content: "";
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }

        .social-card {
            display: flex;
            min-height: 64px;
            align-items: center;
            gap: 14px;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            padding: 14px 18px;
            background: #fff;
            box-shadow: 0 10px 28px rgba(15, 23, 42, .04);
        }

        .social-card b {
            display: block;
            font-size: 13px;
            font-weight: 900;
        }

        .social-card span {
            color: var(--muted);
            font-size: 12px;
        }

        .journey {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 34px;
            align-items: center;
            margin-top: 28px;
            padding: 28px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 16px 38px rgba(15, 23, 42, .06);
        }

        .timeline {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
        }

        .time-item {
            border-left: 1px solid #dbe4ee;
            padding-left: 18px;
        }

        .time-item b {
            display: block;
            margin: 10px 0 4px;
            font-size: 20px;
        }

        .time-item p {
            color: var(--muted);
            font-size: 13px;
        }

        .quote-strip,
        .newsletter {
            border-radius: 8px;
            background: linear-gradient(135deg, #06111f, #0b2038);
            color: #fff;
        }

        .quote-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 28px 34px;
            font-size: 18px;
            font-weight: 700;
        }

        .newsletter {
            display: grid;
            grid-template-columns: 1fr 430px;
            gap: 34px;
            align-items: center;
            padding: 30px;
        }

        .newsletter p {
            color: rgba(255, 255, 255, .72);
        }

        .email-row {
            display: flex;
            gap: 14px;
        }

        .email-row input {
            width: 100%;
            min-height: 48px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 7px;
            padding: 0 16px;
            background: transparent;
            color: #fff;
            outline: none;
        }

        .placeholder-hero {
            padding: 76px 0;
            background: linear-gradient(135deg, #020815, #061426 54%, #020814);
            color: #fff;
        }

        .placeholder-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .placeholder-card {
            min-height: 210px;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            padding: 28px;
            background: #fff;
        }

        .placeholder-card h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: 900;
        }

        .placeholder-card p {
            color: var(--muted);
        }

        .tool-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .community-hero {
            background:
                linear-gradient(90deg, rgba(2, 8, 21, .98), rgba(2, 8, 21, .7) 44%, rgba(2, 8, 21, .2)),
                url('/images/community-hero.png') center right / cover no-repeat,
                linear-gradient(135deg, #020815, #061426);
        }

        .community-hero-inner {
            display: grid;
            grid-template-columns: .8fr 1.15fr;
            min-height: 340px;
            align-items: center;
            gap: 42px;
            padding: 50px 0;
        }

        .community-hero h1 {
            max-width: 520px;
            font-size: clamp(42px, 4.2vw, 60px);
            line-height: 1.1;
            font-weight: 900;
        }

        .community-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 30px;
        }

        .community-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            align-self: end;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 8px;
            background: rgba(4, 12, 24, .56);
            backdrop-filter: blur(16px);
        }

        .community-stat {
            min-height: 122px;
            padding: 24px;
            border-right: 1px solid rgba(255, 255, 255, .12);
        }

        .community-stat:last-child {
            border-right: 0;
        }

        .community-stat svg {
            margin-bottom: 12px;
            color: rgba(255, 255, 255, .78);
        }

        .community-stat b {
            display: block;
            color: #fff;
            font-size: 26px;
            line-height: 1;
        }

        .community-stat span {
            color: rgba(255, 255, 255, .8);
            font-size: 13px;
            font-weight: 600;
        }

        .community-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 12px;
            overflow-x: auto;
        }

        .community-tabs {
            display: flex;
            min-width: max-content;
            gap: 36px;
        }

        .community-tab {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 22px 0 18px;
            border-bottom: 3px solid transparent;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
        }

        .community-tab.active {
            border-color: var(--gold);
            color: #111827;
        }

        .community-tab svg {
            color: currentColor;
        }

        .community-layout {
            display: grid;
            grid-template-columns: 1fr 335px;
            gap: 28px;
            align-items: start;
        }

        .panel {
            overflow: hidden;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 12px 32px rgba(15, 23, 42, .05);
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 20px 22px;
            border-bottom: 1px solid #e1e8f0;
        }

        .panel-head h2,
        .side-card h3 {
            font-size: 18px;
            font-weight: 900;
        }

        .panel-head p {
            color: var(--muted);
            font-size: 13px;
        }

        .select-pill {
            min-height: 34px;
            border: 1px solid #dbe4ee;
            border-radius: 6px;
            padding: 0 12px;
            background: #fff;
            font-size: 13px;
            font-weight: 700;
        }

        .post {
            display: grid;
            grid-template-columns: 52px 1fr;
            gap: 16px;
            padding: 20px 22px;
            border-bottom: 1px solid #e1e8f0;
        }

        .post:last-child {
            border-bottom: 0;
        }

        .avatar-img {
            position: relative;
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffd7a1, #1d4f73);
            color: #06111f;
            font-size: 14px;
            font-weight: 900;
            box-shadow: inset 0 0 0 2px rgba(255, 255, 255, .7);
        }

        .avatar-img::after {
            position: absolute;
            right: 1px;
            bottom: 1px;
            width: 11px;
            height: 11px;
            border: 2px solid #fff;
            border-radius: 50%;
            background: #22c55e;
            content: "";
        }

        .post-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .post-meta b {
            color: #111827;
        }

        .badge {
            display: inline-flex;
            min-height: 22px;
            align-items: center;
            border-radius: 999px;
            padding: 0 9px;
            background: #eef4ff;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 800;
        }

        .badge.gold-badge {
            background: #fff2d5;
            color: #d97706;
        }

        .badge.green-badge {
            background: #dcfce7;
            color: #047857;
        }

        .badge.pink-badge {
            background: #fce7f3;
            color: #be185d;
        }

        .post h3 {
            margin-bottom: 6px;
            font-size: 17px;
            font-weight: 900;
        }

        .post p {
            color: #344054;
            font-size: 14px;
            line-height: 1.65;
        }

        .post-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 14px;
            color: #334155;
            font-size: 13px;
        }

        .post-actions div {
            display: flex;
            gap: 26px;
        }

        .share-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin: 18px;
            padding: 18px;
            border-radius: 8px;
            background: linear-gradient(100deg, #f7fbff, #eef6ff);
        }

        .share-box strong {
            display: block;
            font-size: 15px;
        }

        .sidebar {
            display: grid;
            gap: 18px;
        }

        .side-card {
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            padding: 22px;
            background: #fff;
            box-shadow: 0 12px 32px rgba(15, 23, 42, .05);
        }

        .side-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .spotlight {
            display: grid;
            grid-template-columns: 70px 1fr;
            gap: 16px;
            align-items: center;
        }

        .spotlight .avatar-img {
            width: 64px;
            height: 64px;
            font-size: 18px;
        }

        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 22px;
            text-align: center;
        }

        .mini-stats b {
            display: block;
            font-size: 18px;
        }

        .mini-stats span {
            color: var(--muted);
            font-size: 12px;
        }

        .online-row {
            display: flex;
            margin: 10px 0 14px;
        }

        .online-row .avatar-img {
            width: 36px;
            height: 36px;
            margin-right: -8px;
            border: 2px solid #fff;
            font-size: 11px;
        }

        .event-list {
            display: grid;
            gap: 18px;
        }

        .event-item {
            display: grid;
            grid-template-columns: 48px 1fr;
            gap: 14px;
            padding-bottom: 18px;
            border-bottom: 1px solid #e1e8f0;
        }

        .event-item:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .event-item b {
            display: block;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .event-item p,
        .guidelines li {
            color: var(--muted);
            font-size: 13px;
        }

        .guidelines {
            display: grid;
            gap: 10px;
            padding-left: 18px;
        }

        .category-row {
            margin-top: 24px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-top: 18px;
        }

        .category-card {
            min-height: 164px;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .04);
        }

        .category-card h3 {
            margin: 14px 0 6px;
            font-size: 14px;
            font-weight: 900;
        }

        .category-card p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .category-card a {
            display: inline-block;
            margin-top: 12px;
            color: var(--blue);
            font-size: 12px;
            font-weight: 900;
        }

        .tools-hero {
            background:
                linear-gradient(90deg, rgba(2, 8, 21, .98), rgba(2, 8, 21, .72) 46%, rgba(2, 8, 21, .1)),
                url('/images/tools-hero.png') center right / cover no-repeat,
                linear-gradient(135deg, #020815, #061426);
        }

        .tools-hero-inner,
        .blog-hero-inner {
            min-height: 355px;
            padding: 54px 0;
        }

        .tools-hero h1 {
            max-width: 720px;
            font-size: clamp(40px, 4vw, 56px);
        }

        .tools-points {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px;
            max-width: 760px;
            margin-top: 34px;
        }

        .tool-point {
            display: grid;
            grid-template-columns: 42px 1fr;
            gap: 12px;
            align-items: center;
            color: rgba(255, 255, 255, .86);
            font-size: 13px;
            font-weight: 700;
        }

        .soft-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }

        .resource-card {
            min-height: 248px;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            padding: 22px;
            background: #fff;
            box-shadow: 0 14px 34px rgba(15, 23, 42, .045);
        }

        .resource-card h3 {
            margin: 18px 0 10px;
            font-size: 17px;
            font-weight: 900;
            line-height: 1.25;
        }

        .resource-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .resource-card a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 18px;
            color: var(--blue);
            font-size: 13px;
            font-weight: 900;
        }

        .icon-tile {
            display: grid;
            width: 64px;
            height: 64px;
            place-items: center;
            border-radius: 12px;
            background: #eef4ff;
            color: var(--blue);
            font-size: 22px;
            font-weight: 900;
        }

        .icon-tile.gold-bg {
            background: #fff2d5;
            color: #d97706;
        }

        .icon-tile.green-bg {
            background: #dcfce7;
            color: #047857;
        }

        .icon-tile.purple-bg {
            background: #f3e8ff;
            color: #7e22ce;
        }

        .icon-tile.pink-bg {
            background: #fce7f3;
            color: #be185d;
        }

        .category-soft {
            min-height: 196px;
        }

        .toolkit-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .toolkit-card {
            overflow: hidden;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 14px 34px rgba(15, 23, 42, .045);
        }

        .toolkit-img {
            min-height: 150px;
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .85), rgba(6, 17, 31, .2)),
                url('/images/life-decode-hero.png') center / cover no-repeat;
        }

        .toolkit-img.green-img {
            background:
                linear-gradient(90deg, rgba(6, 45, 38, .86), rgba(9, 86, 55, .25)),
                radial-gradient(circle at 70% 35%, rgba(255, 187, 46, .35), transparent 24%),
                linear-gradient(135deg, #062d26, #102a43);
        }

        .toolkit-img.purple-img {
            background:
                linear-gradient(90deg, rgba(26, 18, 55, .86), rgba(77, 40, 110, .25)),
                radial-gradient(circle at 72% 36%, rgba(255, 187, 46, .34), transparent 20%),
                linear-gradient(135deg, #1a1237, #4b1d65);
        }

        .toolkit-body {
            padding: 20px;
        }

        .toolkit-body h3 {
            margin-bottom: 8px;
            font-size: 18px;
            font-weight: 900;
        }

        .toolkit-body p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.65;
        }

        .mini-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }

        .mini-tags span {
            display: inline-flex;
            min-height: 26px;
            align-items: center;
            border-radius: 5px;
            padding: 0 8px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .toolkit-link {
            display: block;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #e1e8f0;
            color: var(--blue);
            font-size: 13px;
            font-weight: 900;
            text-align: center;
        }

        .how-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 26px;
            margin-top: 28px;
            border-radius: 8px;
            padding: 30px;
            background: linear-gradient(100deg, #fff8e8, #fff 48%, #fff3d9);
        }

        .how-step {
            display: grid;
            grid-template-columns: 72px 1fr;
            gap: 16px;
            align-items: center;
        }

        .step-num {
            display: inline-grid;
            width: 20px;
            height: 20px;
            place-items: center;
            border-radius: 50%;
            background: var(--gold);
            color: #06111f;
            font-size: 11px;
            font-weight: 900;
        }

        .how-step b {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 900;
        }

        .how-step p {
            color: var(--muted);
            font-size: 12px;
        }

        .blog-hero {
            background:
                linear-gradient(90deg, rgba(2, 8, 21, .98), rgba(2, 8, 21, .68) 46%, rgba(2, 8, 21, .06)),
                url('/images/life-decode-hero.png') center right / cover no-repeat,
                linear-gradient(135deg, #020815, #061426);
        }

        .search-box {
            display: flex;
            width: min(380px, 100%);
            min-height: 46px;
            align-items: center;
            gap: 10px;
            margin-top: 24px;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 7px;
            padding: 0 14px;
            background: rgba(255, 255, 255, .04);
        }

        .search-box input {
            width: 100%;
            border: 0;
            background: transparent;
            color: #fff;
            outline: 0;
        }

        .blog-tabs {
            display: flex;
            gap: 34px;
            overflow-x: auto;
            border-bottom: 1px solid #e1e8f0;
        }

        .blog-tabs a {
            display: inline-flex;
            min-width: max-content;
            align-items: center;
            gap: 9px;
            padding: 22px 0 18px;
            border-bottom: 3px solid transparent;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .blog-tabs a.active {
            border-color: var(--gold);
            color: #111827;
        }

        .blog-layout {
            display: grid;
            grid-template-columns: 1fr 310px;
            gap: 34px;
            align-items: start;
            margin-top: 24px;
        }

        .featured-post {
            display: grid;
            grid-template-columns: 1.08fr .8fr;
            overflow: hidden;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 14px 34px rgba(15, 23, 42, .045);
        }

        .post-image {
            min-height: 250px;
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .2), rgba(6, 17, 31, .45)),
                url('/images/life-decode-hero.png') center / cover no-repeat;
        }

        .post-image.bias-img {
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .12), rgba(6, 17, 31, .45)),
                url('/images/about-creator.png') center / cover no-repeat;
        }

        .post-image.desk-img {
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .06), rgba(6, 17, 31, .32)),
                url('/images/about-desk.png') center / cover no-repeat;
        }

        .featured-copy {
            padding: 30px;
        }

        .overline {
            color: var(--blue);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .featured-copy h2 {
            margin: 12px 0;
            font-size: 26px;
            font-weight: 900;
            line-height: 1.15;
        }

        .article-listing {
            margin-top: 26px;
            overflow: hidden;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            background: #fff;
        }

        .article-row {
            display: grid;
            grid-template-columns: 220px 1fr 24px;
            gap: 22px;
            padding: 18px;
            border-bottom: 1px solid #e1e8f0;
        }

        .article-row:last-child {
            border-bottom: 0;
        }

        .article-thumb {
            min-height: 126px;
            border-radius: 8px;
            background:
                radial-gradient(circle at 55% 32%, rgba(255, 187, 46, .55), transparent 18%),
                linear-gradient(135deg, #06111f, #233652);
        }

        .article-thumb.bias-img {
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .14), rgba(6, 17, 31, .44)),
                url('/images/about-creator.png') center / cover no-repeat;
        }

        .article-thumb.mindset-img {
            background:
                radial-gradient(circle at 68% 34%, rgba(255, 187, 46, .3), transparent 20%),
                linear-gradient(135deg, #27324a, #9a6f5f 48%, #101827);
        }

        .article-thumb.human-img {
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .18), rgba(6, 17, 31, .4)),
                url('/images/life-decode-hero.png') center / cover no-repeat;
        }

        .article-thumb.desk-img {
            background:
                linear-gradient(90deg, rgba(6, 17, 31, .06), rgba(6, 17, 31, .3)),
                url('/images/about-desk.png') center / cover no-repeat;
        }

        .article-thumb.philosophy-img {
            background:
                radial-gradient(circle at 54% 24%, rgba(255, 187, 46, .28), transparent 20%),
                linear-gradient(135deg, #201b19, #5e5249);
        }

        .article-thumb.case-img {
            background:
                radial-gradient(circle at 55% 45%, rgba(255, 187, 46, .58), transparent 16%),
                linear-gradient(135deg, #1f2937, #4b5563);
        }

        .article-row h3 {
            margin: 8px 0;
            font-size: 20px;
            font-weight: 900;
            line-height: 1.2;
        }

        .article-row p,
        .article-row small {
            color: var(--muted);
            font-size: 13px;
        }

        .blog-side {
            display: grid;
            gap: 22px;
        }

        .topic-list {
            display: grid;
            gap: 15px;
        }

        .topic-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #334155;
            font-size: 14px;
        }

        .count-pill {
            display: inline-grid;
            min-width: 30px;
            min-height: 24px;
            place-items: center;
            border-radius: 999px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 800;
        }

        .mini-post {
            display: grid;
            grid-template-columns: 72px 1fr;
            gap: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid #e1e8f0;
        }

        .mini-post:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .mini-thumb {
            min-height: 60px;
            border-radius: 7px;
            background:
                radial-gradient(circle at 50% 35%, rgba(255, 187, 46, .5), transparent 18%),
                linear-gradient(135deg, #06111f, #20354f);
        }

        .mini-post b {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            line-height: 1.35;
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 22px;
        }

        .page-pill {
            display: inline-grid;
            min-width: 36px;
            min-height: 34px;
            place-items: center;
            border: 1px solid #dbe4ee;
            border-radius: 6px;
            background: #fff;
            color: #334155;
            font-size: 13px;
            font-weight: 800;
        }

        .page-pill.active {
            background: #06111f;
            color: #fff;
        }

        .site-footer {
            margin-top: 0;
            padding: 54px 0;
            background: linear-gradient(135deg, #06111f, #04101d);
            color: rgba(255, 255, 255, .72);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr repeat(4, 1fr) 1.25fr;
            gap: 36px;
        }

        .site-footer h4 {
            margin-bottom: 14px;
            color: #fff;
            font-size: 13px;
            font-weight: 900;
        }

        .site-footer a,
        .site-footer p {
            display: block;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, .66);
            font-size: 13px;
        }

        .footer-quote {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.6;
        }

        @media (max-width: 1050px) {
            .nav-links {
                display: none;
            }

            .about-hero,
            .split,
            .approach,
            .journey,
            .newsletter {
                grid-template-columns: 1fr;
            }

            .about-hero-art {
                min-height: 360px;
                mask-image: none;
                border-radius: 10px 10px 0 0;
            }

            .hero-metrics,
            .social-grid,
            .process,
            .placeholder-grid,
            .community-hero-inner,
            .community-layout {
                grid-template-columns: repeat(2, 1fr);
            }

            .community-hero-inner,
            .community-layout {
                grid-template-columns: 1fr;
            }

            .category-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .soft-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .toolkit-grid,
            .how-strip,
            .blog-layout {
                grid-template-columns: 1fr;
            }

            .featured-post {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 680px) {
            .shell {
                width: min(100% - 28px, 1180px);
            }

            .nav {
                min-height: 66px;
            }

            .brand strong {
                font-size: 19px;
            }

            .brand small,
            .icon-btn {
                display: none;
            }

            .nav-actions .btn {
                min-height: 42px;
                padding: 0 16px;
                font-size: 13px;
            }

            .page-hero h1 {
                font-size: 40px;
            }

            .about-hero {
                padding-top: 36px;
            }

            .hero-metrics,
            .mission-grid,
            .process,
            .social-grid,
            .timeline,
            .placeholder-grid,
            .tool-cards,
            .community-stats,
            .category-grid,
            .soft-grid,
            .tools-points,
            .toolkit-grid,
            .how-strip,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .tools-hero,
            .blog-hero {
                background:
                    linear-gradient(180deg, rgba(2, 8, 21, .98), rgba(2, 8, 21, .72)),
                    var(--mobile-hero-image, none),
                    linear-gradient(135deg, #020815, #061426);
                background-position: center;
                background-size: cover;
            }

            .tools-hero {
                --mobile-hero-image: url('/images/tools-hero.png');
            }

            .blog-hero {
                --mobile-hero-image: url('/images/life-decode-hero.png');
            }

            .tools-points {
                gap: 16px;
            }

            .article-row {
                grid-template-columns: 1fr;
            }

            .article-thumb,
            .post-image {
                min-height: 190px;
            }

            .community-hero {
                background:
                    linear-gradient(180deg, rgba(2, 8, 21, .98), rgba(2, 8, 21, .72)),
                    url('/images/community-hero.png') center / cover no-repeat,
                    linear-gradient(135deg, #020815, #061426);
            }

            .community-hero-inner {
                min-height: auto;
                padding: 42px 0 28px;
            }

            .community-stats {
                margin-top: 18px;
            }

            .community-stat {
                min-height: 92px;
                border-right: 0;
                border-bottom: 1px solid rgba(255, 255, 255, .12);
            }

            .community-stat:last-child {
                border-bottom: 0;
            }

            .community-nav {
                align-items: stretch;
                flex-direction: column;
            }

            .community-tabs {
                gap: 24px;
            }

            .post {
                grid-template-columns: 42px 1fr;
                padding: 18px;
            }

            .avatar-img {
                width: 40px;
                height: 40px;
            }

            .share-box,
            .post-actions {
                align-items: flex-start;
                flex-direction: column;
            }

            .spotlight {
                grid-template-columns: 56px 1fr;
            }

            .hero-metric {
                padding: 18px;
            }

            .approach,
            .journey,
            .newsletter {
                padding: 22px;
            }

            .email-row,
            .quote-strip {
                align-items: flex-start;
                flex-direction: column;
            }

            .creator-photo img {
                height: 280px;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="shell nav">
            <a class="brand" href="/">
                <span class="brand-mark" aria-hidden="true">LD</span>
                <span>
                    <strong>LIFE <span>DECODE</span></strong>
                    <small>Decode life. Live amplified.</small>
                </span>
            </a>

            <nav class="nav-links" aria-label="Primary navigation">
                <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                <a class="{{ request()->routeIs('life-decode.library') ? 'active' : '' }}" href="{{ route('life-decode.library') }}">Library</a>
                <a class="{{ request()->routeIs('life-decode.blog') ? 'active' : '' }}" href="{{ route('life-decode.blog') }}">Blog</a>
                <a class="{{ request()->routeIs('life-decode.tools') ? 'active' : '' }}" href="{{ route('life-decode.tools') }}">Tools</a>
                <a class="{{ request()->routeIs('life-decode.community') ? 'active' : '' }}" href="{{ route('life-decode.community') }}">Community</a>
                <a class="{{ request()->routeIs('life-decode.about') ? 'active' : '' }}" href="{{ route('life-decode.about') }}">About</a>
            </nav>

            <div class="nav-actions">
                <button class="icon-btn" type="button" aria-label="Search">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <a class="btn btn-primary" href="{{ route('life-decode.tools') }}">The Mental Toolkit
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </header>

    @yield('content')

    <section class="section" style="padding-bottom:0;">
        <div class="shell newsletter">
            <div>
                <h3>Get weekly insights to decode life</h3>
                <p>and live it with more clarity.</p>
            </div>
            <form class="email-row">
                <input type="email" placeholder="Enter your email" aria-label="Newsletter email">
                <button class="btn btn-primary" type="button">Subscribe</button>
            </form>
        </div>
    </section>

    <footer class="site-footer">
        <div class="shell footer-grid">
            <div>
                <a class="brand" href="/">
                    <span class="brand-mark" aria-hidden="true">LD</span>
                    <span>
                        <strong>LIFE <span>DECODE</span></strong>
                        <small>Decode life. Live amplified.</small>
                    </span>
                </a>
                <p style="margin-top:18px;">A knowledge hub for understanding psychology, behavior, and life systems to help you think clearly and live intentionally.</p>
            </div>
            <div><h4>Explore</h4><a href="/">Home</a><a href="{{ route('life-decode.library') }}">Library</a><a href="{{ route('life-decode.blog') }}">Blog</a><a href="{{ route('life-decode.tools') }}">Tools</a></div>
            <div><h4>Community</h4><a href="{{ route('life-decode.community') }}">Community</a><a href="#">Discussions</a><a href="#">Study Groups</a><a href="#">Events</a></div>
            <div><h4>Resources</h4><a href="#">Downloads</a><a href="#">Templates</a><a href="#">Cheatsheets</a><a href="#">Frameworks</a></div>
            <div><h4>Company</h4><a href="{{ route('life-decode.about') }}">About</a><a href="#">Contact</a><a href="#">Work With Me</a></div>
            <div class="footer-quote"><span class="gold">"</span><br>The more you understand, the more freedom you gain.<br><small>- Life Decode</small></div>
        </div>
    </footer>
</body>
</html>
