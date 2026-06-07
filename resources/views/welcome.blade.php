<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Life Decode - Decode life. Live amplified.</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #07111f;
            --ink-soft: #0b1d32;
            --line: rgba(255, 255, 255, .14);
            --muted: #5c6675;
            --gold: #ffbb2e;
            --gold-dark: #ee9e0f;
            --blue: #0b63ce;
            --paper: #f7f9fc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--paper);
            color: #0f172a;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.5;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        .shell {
            width: min(1180px, calc(100% - 48px));
            margin: 0 auto;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(4, 12, 24, .88);
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(18px);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 74px;
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
        }

        .brand strong {
            display: block;
            color: #fff;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 0;
            line-height: 1;
        }

        .brand span span,
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
            color: rgba(255, 255, 255, .82);
            font-size: 14px;
            font-weight: 700;
        }

        .nav-links a {
            position: relative;
            padding: 28px 0;
        }

        .nav-links a:first-child {
            color: var(--gold);
        }

        .nav-links a:first-child::after {
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
            align-items: center;
            justify-content: center;
            min-height: 44px;
            gap: 10px;
            border-radius: 7px;
            padding: 0 22px;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 800;
            transition: transform .2s ease, border-color .2s ease, background .2s ease;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(180deg, #ffc449, var(--gold));
            color: #08111d;
            box-shadow: 0 12px 26px rgba(255, 187, 46, .24);
        }

        .btn-dark {
            border-color: rgba(255, 255, 255, .18);
            color: #fff;
            background: rgba(255, 255, 255, .03);
        }

        .hero-wrap {
            background:
                radial-gradient(circle at 64% 22%, rgba(255, 187, 46, .16), transparent 32%),
                radial-gradient(circle at 12% 18%, rgba(20, 116, 214, .18), transparent 30%),
                linear-gradient(135deg, #020815, #061426 48%, #020814);
            color: #fff;
        }

        .hero {
            display: grid;
            grid-template-columns: .98fr 1.1fr;
            align-items: center;
            min-height: 620px;
            gap: 56px;
            padding: 62px 0 28px;
        }

        .eyebrow {
            margin-bottom: 20px;
            color: var(--gold);
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .hero h1 {
            max-width: 630px;
            font-size: clamp(42px, 5vw, 76px);
            font-weight: 900;
            letter-spacing: 0;
            line-height: 1.08;
        }

        .hero-copy {
            max-width: 540px;
            margin-top: 24px;
            color: rgba(255, 255, 255, .76);
            font-size: 18px;
            line-height: 1.75;
        }

        .hero-cta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 34px;
        }

        .quick-points {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-top: 34px;
            padding-top: 22px;
            border-top: 1px solid rgba(255, 255, 255, .12);
            color: rgba(255, 255, 255, .78);
            font-size: 12px;
            font-weight: 700;
        }

        .quick-points div {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tiny-icon {
            display: grid;
            width: 28px;
            height: 28px;
            flex: 0 0 28px;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .36);
            border-radius: 50%;
            color: #fff;
        }

        .hero-visual {
            position: relative;
            min-height: 470px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 14px;
            background: #06101d;
            box-shadow: 0 32px 80px rgba(0, 0, 0, .38);
        }

        .hero-visual img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-visual::after {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(5, 12, 23, .78), rgba(5, 12, 23, .16) 55%, rgba(255, 187, 46, .1));
            content: "";
        }

        .topic-orbit {
            position: absolute;
            z-index: 2;
            display: grid;
            gap: 30px;
            right: 34px;
            top: 70px;
            color: rgba(255, 255, 255, .9);
            font-size: 11px;
            font-weight: 900;
            text-align: center;
            text-transform: uppercase;
        }

        .orbit-left {
            right: auto;
            left: 34px;
            top: 86px;
        }

        .topic-orbit span {
            display: grid;
            justify-items: center;
            gap: 8px;
        }

        .play-badge {
            position: absolute;
            z-index: 3;
            right: 44px;
            bottom: 36px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 999px;
            padding: 10px 16px;
            background: rgba(2, 8, 21, .7);
            color: #fff;
            font-weight: 800;
            backdrop-filter: blur(12px);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1px;
            margin-top: 14px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 8px;
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(16px);
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px 24px;
            background: rgba(4, 14, 27, .7);
        }

        .stat b {
            display: block;
            color: #fff;
            font-size: 22px;
            line-height: 1;
        }

        .stat span {
            color: rgba(255, 255, 255, .64);
            font-size: 12px;
            font-weight: 600;
        }

        .section {
            padding: 48px 0;
        }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .section h2 {
            color: #111827;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 0;
        }

        .link-blue {
            color: #0b63ce;
            font-size: 14px;
            font-weight: 800;
        }

        .topics {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 18px;
        }

        .topic-card {
            min-height: 226px;
            padding: 28px 22px;
            border: 1px solid #e4e9f1;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .04);
            text-align: center;
        }

        .topic-card .topic-icon {
            display: grid;
            width: 58px;
            height: 58px;
            margin: 0 auto 22px;
            place-items: center;
            border-radius: 50%;
            background: #06111f;
            color: var(--gold);
        }

        .topic-card h3 {
            margin-bottom: 14px;
            color: #111827;
            font-size: 15px;
            font-weight: 900;
        }

        .topic-card p {
            min-height: 56px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .topic-card a {
            display: inline-block;
            margin-top: 18px;
            color: #0b63ce;
            font-size: 13px;
            font-weight: 900;
        }

        .content-grid {
            display: grid;
            grid-template-columns: .96fr 1fr;
            gap: 58px;
            padding-top: 8px;
        }

        .video-card {
            overflow: hidden;
            border: 1px solid #dde5ef;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 16px 36px rgba(15, 23, 42, .06);
        }

        .video-thumb {
            position: relative;
            min-height: 300px;
            background:
                radial-gradient(circle at 52% 44%, rgba(255, 255, 255, .24), transparent 18%),
                linear-gradient(135deg, #111a47, #06111f);
        }

        .video-thumb::before {
            position: absolute;
            inset: 0;
            background: url('/images/life-decode-hero.png') center / cover;
            opacity: .54;
            content: "";
        }

        .play {
            position: absolute;
            inset: 50% auto auto 50%;
            display: grid;
            width: 74px;
            height: 74px;
            place-items: center;
            border-radius: 50%;
            background: rgba(0, 0, 0, .56);
            color: #fff;
            transform: translate(-50%, -50%);
        }

        .video-meta {
            padding: 24px;
        }

        .video-meta h3 {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 900;
        }

        .video-meta p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .chips {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
            gap: 14px;
        }

        .chips span {
            display: inline-flex;
            margin-right: 8px;
            padding: 7px 10px;
            border-radius: 6px;
            background: #edf2f8;
            color: #415065;
            font-size: 12px;
            font-weight: 700;
        }

        .article-list {
            display: grid;
            gap: 21px;
        }

        .article {
            display: grid;
            grid-template-columns: 118px 1fr;
            gap: 18px;
            padding-bottom: 21px;
            border-bottom: 1px solid #dde5ef;
        }

        .article-img {
            min-height: 82px;
            border-radius: 8px;
            background:
                radial-gradient(circle at 55% 30%, rgba(255, 187, 46, .8), transparent 20%),
                linear-gradient(135deg, #06111f, #182b43);
        }

        .article h3 {
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 900;
        }

        .article p,
        .article small {
            color: var(--muted);
            font-size: 13px;
        }

        .toolkit {
            display: grid;
            grid-template-columns: 300px 1fr 330px;
            gap: 42px;
            align-items: center;
            margin-top: 18px;
            padding: 44px;
            border-radius: 8px;
            background: linear-gradient(100deg, #edf7ff, #f8fbff 48%, #eaf3ff);
        }

        .book {
            min-height: 310px;
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(255, 187, 46, .9), rgba(255, 187, 46, 0) 28%),
                linear-gradient(160deg, #07111f, #10294a);
            box-shadow: 20px 22px 38px rgba(15, 23, 42, .18);
            color: #fff;
            padding: 38px 28px;
            transform: rotate(-4deg);
        }

        .book b {
            display: block;
            font-size: 30px;
            font-weight: 900;
            line-height: 1.05;
        }

        .book span {
            display: block;
            margin-top: 16px;
            color: rgba(255, 255, 255, .74);
            font-size: 13px;
            max-width: 180px;
        }

        .label {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 11px;
            border-radius: 999px;
            background: #e6f0ff;
            color: #0b63ce;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .toolkit h2 {
            margin-bottom: 12px;
            font-size: 30px;
        }

        .toolkit p {
            color: var(--muted);
            line-height: 1.75;
        }

        .checks {
            display: grid;
            gap: 10px;
            margin-top: 20px;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
        }

        .signup-box {
            padding: 28px;
            border: 1px solid #e1e8f0;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .08);
        }

        .signup-box h3 {
            margin-bottom: 8px;
            font-size: 17px;
            font-weight: 900;
        }

        .signup-box p {
            margin-bottom: 18px;
            color: var(--muted);
            font-size: 13px;
        }

        .email-row {
            display: flex;
            gap: 14px;
        }

        .email-row input,
        .signup-box input {
            width: 100%;
            height: 48px;
            border: 1px solid #d7e0eb;
            border-radius: 7px;
            padding: 0 16px;
            color: #111827;
            outline: none;
        }

        .signup-box .btn {
            width: 100%;
            margin-top: 14px;
        }

        .community {
            display: grid;
            grid-template-columns: 1fr 430px;
            gap: 58px;
            align-items: center;
        }

        .community h2 {
            margin-bottom: 12px;
        }

        .features-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 46px;
        }

        .mini-feature {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .mini-feature b {
            display: block;
            margin: 12px 0 6px;
            color: #111827;
            font-size: 14px;
        }

        .quote-card {
            padding: 38px;
            border-radius: 8px;
            background: linear-gradient(135deg, #06111f, #0b2038);
            color: #fff;
            box-shadow: 0 20px 48px rgba(15, 23, 42, .16);
        }

        .avatars {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
        }

        .avatar {
            display: grid;
            width: 38px;
            height: 38px;
            margin-right: -8px;
            place-items: center;
            border: 2px solid #0b2038;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffe0b2, #375b7b);
            color: #07111f;
            font-size: 12px;
            font-weight: 900;
        }

        .stars {
            margin-left: 18px;
            color: var(--gold);
            font-weight: 900;
        }

        .quote-card p {
            color: rgba(255, 255, 255, .82);
            font-size: 17px;
            line-height: 1.7;
        }

        .newsletter {
            display: grid;
            grid-template-columns: 1fr 480px;
            gap: 34px;
            align-items: center;
            margin: 16px 0 0;
            padding: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #06111f, #0b1d32);
            color: #fff;
        }

        .newsletter h3 {
            margin-bottom: 6px;
            font-size: 20px;
            font-weight: 900;
        }

        .newsletter p {
            color: rgba(255, 255, 255, .72);
        }

        .newsletter input {
            background: transparent;
            border-color: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .site-footer {
            margin-top: 48px;
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

        svg {
            display: block;
        }

        @media (max-width: 1050px) {
            .nav-links {
                display: none;
            }

            .hero,
            .content-grid,
            .toolkit,
            .community,
            .newsletter {
                grid-template-columns: 1fr;
            }

            .topics {
                grid-template-columns: repeat(3, 1fr);
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
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
            .icon-btn,
            .nav-actions .btn-dark {
                display: none;
            }

            .hero {
                min-height: auto;
                padding-top: 42px;
            }

            .hero-copy {
                font-size: 16px;
            }

            .hero-visual {
                min-height: 360px;
            }

            .quick-points,
            .topics,
            .features-row,
            .stats,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .topic-orbit {
                display: none;
            }

            .section-head,
            .email-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .toolkit,
            .newsletter {
                padding: 24px;
            }

            .article {
                grid-template-columns: 92px 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="shell nav">
            <a class="brand" href="/">
                <span class="brand-mark" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M9 4a4 4 0 0 0-4 4v1a4 4 0 0 0 0 6v1a4 4 0 0 0 4 4m6-16a4 4 0 0 1 4 4v1a4 4 0 0 1 0 6v1a4 4 0 0 1-4 4M9 4v16m6-16v16M7 9h4m2 0h4M7 15h4m2 0h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span>
                    <strong>LIFE <span>DECODE</span></strong>
                    <small>Decode life. Live amplified.</small>
                </span>
            </a>

            <nav class="nav-links" aria-label="Primary navigation">
                <a href="/">Home</a>
                <a href="{{ route('life-decode.library') }}">Library</a>
                <a href="{{ route('life-decode.blog') }}">Blog</a>
                <a href="{{ route('life-decode.tools') }}">Tools</a>
                <a href="{{ route('life-decode.community') }}">Community</a>
                <a href="{{ route('life-decode.about') }}">About</a>
            </nav>

            <div class="nav-actions">
                <button class="icon-btn" type="button" aria-label="Search">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                @if (Route::has('tyro-login.login'))
                    <a class="btn btn-dark" href="{{ route('tyro-login.login') }}">Login</a>
                @endif
                @if (Route::has('tyro-login.register'))
                    <a class="btn btn-primary" href="{{ route('tyro-login.register') }}">Join Community</a>
                @else
                    <a class="btn btn-primary" href="{{ route('life-decode.community') }}">Join Community</a>
                @endif
            </div>
        </div>
    </header>

    <main>
        <section class="hero-wrap">
            <div class="shell hero">
                <div>
                    <p class="eyebrow">Understand the hidden patterns</p>
                    <h1>Understand the patterns. <span class="gold">Upgrade</span> your life.</h1>
                    <p class="hero-copy">Life Decode helps you understand the psychology behind your thoughts, decisions, and behavior so you can make better choices and live with clarity and purpose.</p>

                    <div class="hero-cta">
                        <a class="btn btn-primary" href="{{ route('life-decode.library') }}">Explore Library
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a class="btn btn-dark" href="{{ route('life-decode.tools') }}">Start With Free Toolkit
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>

                    <div class="quick-points">
                        <div><span class="tiny-icon">i</span>Science-backed insights</div>
                        <div><span class="tiny-icon">T</span>Practical tools</div>
                        <div><span class="tiny-icon">A</span>Actionable strategies</div>
                        <div><span class="tiny-icon">H</span>For a better you</div>
                    </div>
                </div>

                <div class="hero-visual" aria-label="Mind maze artwork">
                    <img src="/images/life-decode-hero.png" alt="Person facing a glowing brain maze">
                    <div class="topic-orbit orbit-left">
                        <span><span class="tiny-icon">P</span>Psychology</span>
                        <span><span class="tiny-icon">M</span>Mindset</span>
                        <span><span class="tiny-icon">D</span>Decisions</span>
                    </div>
                    <div class="topic-orbit">
                        <span><span class="tiny-icon">B</span>Behavior</span>
                        <span><span class="tiny-icon">H</span>Habits</span>
                        <span><span class="tiny-icon">S</span>Life Systems</span>
                    </div>
                    <div class="play-badge">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                        Latest Video
                    </div>
                </div>
            </div>

            <div class="shell stats" aria-label="Life Decode numbers">
                <div class="stat"><span class="tiny-icon">Y</span><div><b>500K+</b><span>YouTube Family</span></div></div>
                <div class="stat"><span class="tiny-icon">V</span><div><b>250+</b><span>In-depth Videos</span></div></div>
                <div class="stat"><span class="tiny-icon">A</span><div><b>78+</b><span>Articles & Guides</span></div></div>
                <div class="stat"><span class="tiny-icon">D</span><div><b>36+</b><span>Free Resources</span></div></div>
                <div class="stat"><span class="tiny-icon">C</span><div><b>100K+</b><span>Community Members</span></div></div>
            </div>
        </section>

        <section class="section" id="library">
            <div class="shell">
                <div class="section-head">
                    <h2>Explore Topics</h2>
                    <a class="link-blue" href="{{ route('life-decode.library') }}">View All Topics
                        <svg style="display:inline-block;vertical-align:-4px" width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="topics">
                    @foreach ([
                        ['Psychology', 'Understand the mind and human behavior.', '28 Articles', 'P'],
                        ['Cognitive Biases', 'Discover hidden biases that influence decisions.', '24 Articles', 'C'],
                        ['Mindset', 'Build a strong mindset for a better life.', '26 Articles', 'M'],
                        ['Mental Models', 'Think clearly. Solve problems better.', '18 Articles', 'N'],
                        ['Productivity', 'Get more done with focus and systems.', '22 Articles', 'F'],
                        ['Philosophy', 'Timeless wisdom for modern life.', '16 Articles', 'L'],
                    ] as [$title, $copy, $count, $icon])
                        <article class="topic-card">
                            <span class="topic-icon">{{ $icon }}</span>
                            <h3>{{ $title }}</h3>
                            <p>{{ $copy }}</p>
                            <a href="#">{{ $count }}</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section" id="blog">
            <div class="shell content-grid">
                <div>
                    <div class="section-head">
                        <h2>Featured Video</h2>
                        <a class="link-blue" href="#">Watch on YouTube</a>
                    </div>

                    <article class="video-card">
                        <div class="video-thumb">
                            <span class="play">
                                <svg width="34" height="34" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </div>
                        <div class="video-meta">
                            <h3>The Halo Effect: How It Affects Every Decision You Make</h3>
                            <p>The halo effect influences your thoughts, relationships, and decisions without you even realizing it. Learn how to stay aware and make better judgments.</p>
                            <div class="chips">
                                <div><span>Cognitive Biases</span><span>Behavior</span></div>
                                <a class="link-blue" href="#">Watch Now</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div>
                    <div class="section-head">
                        <h2>Popular Articles</h2>
                        <a class="link-blue" href="#">View All Articles</a>
                    </div>

                    <div class="article-list">
                        @foreach ([
                            ['10 Cognitive Biases That Control Your Decisions', 'Understand the biases shaping your everyday choices.', 'May 15, 2024  |  12 min read'],
                            ['The Reticular Activating System Explained', 'How your mind filters reality and shapes your focus.', 'May 12, 2024  |  10 min read'],
                            ['Why Most People Never Achieve Their Goals', 'The hidden psychological reasons behind unfulfilled goals.', 'May 8, 2024  |  9 min read'],
                            ['How to Build Discipline That Actually Lasts', 'Science-backed strategies to stay consistent.', 'May 5, 2024  |  11 min read'],
                        ] as [$title, $copy, $meta])
                            <article class="article">
                                <div class="article-img"></div>
                                <div>
                                    <h3>{{ $title }}</h3>
                                    <p>{{ $copy }}</p>
                                    <small>{{ $meta }}</small>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="tools">
            <div class="shell toolkit">
                <div class="book">
                    <b>THE<br>MENTAL<br><span class="gold">TOOLKIT</span></b>
                    <span>Your guide to a better mind and a better life.</span>
                </div>
                <div>
                    <span class="label">Free Download</span>
                    <h2>The Mental Toolkit</h2>
                    <p>Practical exercises and frameworks to decode your mind and design a better life.</p>
                    <div class="checks">
                        <span>✓ Cognitive Bias Cheat Sheet</span>
                        <span>✓ Focus & Productivity Checklist</span>
                        <span>✓ Daily Mind Audit Worksheet</span>
                        <span>✓ Goal Setting Framework</span>
                    </div>
                </div>
                <form class="signup-box">
                    <h3>Get the toolkit in your inbox</h3>
                    <p>Join 25,000+ learners getting weekly insights.</p>
                    <input type="email" placeholder="Enter your email" aria-label="Email address">
                    <button class="btn btn-primary" type="button">Send Me the Toolkit
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <p style="margin:14px 0 0;text-align:center;">No spam. Unsubscribe anytime.</p>
                </form>
            </div>
        </section>

        <section class="section" id="community">
            <div class="shell community">
                <div>
                    <h2>Join a Community of Growth</h2>
                    <p style="color:var(--muted);">Share ideas, ask questions, stay accountable, and grow with like-minded people.</p>
                    <div class="features-row">
                        <div class="mini-feature"><span class="tiny-icon" style="color:#0b63ce;border-color:#bfd3ee">R</span><b>Real Conversations</b>Engage in meaningful discussions.</div>
                        <div class="mini-feature"><span class="tiny-icon" style="color:#0b63ce;border-color:#bfd3ee">S</span><b>Share & Learn</b>Share your experiences and learn together.</div>
                        <div class="mini-feature"><span class="tiny-icon" style="color:#0b63ce;border-color:#bfd3ee">A</span><b>Accountability</b>Stay motivated and hit your goals.</div>
                        <div class="mini-feature"><span class="tiny-icon" style="color:#0b63ce;border-color:#bfd3ee">E</span><b>Events & Challenges</b>Participate in events and level up together.</div>
                    </div>
                </div>

                <article class="quote-card">
                    <div class="avatars">
                        <span class="avatar">A</span><span class="avatar">R</span><span class="avatar">N</span><span class="avatar">S</span><span class="avatar">M</span>
                        <span class="stars">★★★★★ <span style="color:#fff;font-size:13px;">4.9/5</span></span>
                    </div>
                    <p>"This community changed the way I think and live. Surrounded by people who want to grow."</p>
                    <a class="link-blue" style="display:inline-block;margin-top:22px;color:var(--gold);" href="#">Join the Community</a>
                </article>
            </div>
        </section>

        <section class="section" id="newsletter" style="padding-top:20px;">
            <div class="shell newsletter">
                <div>
                    <h3>Decode better. Live better.</h3>
                    <p>Get weekly insights, frameworks, and resources to upgrade your mind.</p>
                </div>
                <form class="email-row">
                    <input type="email" placeholder="Enter your email" aria-label="Newsletter email">
                    <button class="btn btn-primary" type="button">Subscribe</button>
                </form>
            </div>
        </section>
    </main>

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
            <div><h4>Explore</h4><a href="{{ route('life-decode.library') }}">Library</a><a href="{{ route('life-decode.blog') }}">Blog</a><a href="{{ route('life-decode.tools') }}">Tools</a><a href="{{ route('life-decode.community') }}">Community</a></div>
            <div><h4>Topics</h4><a href="#">Psychology</a><a href="#">Cognitive Biases</a><a href="#">Mindset</a><a href="#">Productivity</a></div>
            <div><h4>Resources</h4><a href="{{ route('life-decode.tools') }}">Mental Toolkit</a><a href="#">Worksheets</a><a href="#">Templates</a><a href="#">Guides</a></div>
            <div><h4>Company</h4><a href="{{ route('life-decode.about') }}">About Life Decode</a><a href="#">Contact</a><a href="#">Privacy Policy</a><a href="#">Terms of Use</a></div>
            <div class="footer-quote"><span class="gold">"</span><br>The more you understand, the more freedom you gain.<br><small>- Life Decode</small></div>
        </div>
    </footer>
</body>
</html>
