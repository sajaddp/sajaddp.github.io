# AGENTS.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

Static personal profile website for Sajad Dehshiri, hosted on GitHub Pages at **sajaddehshiri.ir**. No build system—changes go live on push to `prod` branch.

## Key Files

- `index.html` – Main page with inline Tailwind CSS (via CDN), CSS custom properties for light/dark theming, JSON-LD structured data
- `index.md` – Markdown version of profile content (linked as alternate format)
- `llms.txt` – LLM-friendly profile summary following llms.txt convention
- `CNAME` – Custom domain configuration
- `robots.txt`, `sitemap.xml` – SEO configuration

## Content Guidelines

- **Bilingual**: Persian (RTL, primary) and English sections. Persian uses Vazirmatn font, English uses Roboto.
- **Official links must stay in sync** across `index.html`, `index.md`, and `llms.txt`: GitHub, LinkedIn, YouTube, Instagram.
- **SEO-focused**: Structured data, canonical URLs, meta tags, and alternate formats are intentional—preserve them when editing.

## Styling

Theme colors are defined via CSS custom properties in `:root` and `@media (prefers-color-scheme: dark)`. Classes like `.link-primary`, `.link-accent`, `.chip` reference these variables.
