<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    <url>
        <loc>{{route('main-page') }}</loc>
        <priority>1.0</priority>
        <lastmod>
            {{Date::now()}}
        </lastmod>
        <changefreq>monthly</changefreq>
    </url>

    @foreach($pages as $item)
        <url>
            <loc>{{route('static-page',  $item->slug) }}</loc>
            <priority>0.5</priority>
            <lastmod>
                {{$item->updated_at->toAtomString()}}
            </lastmod>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach
    @foreach($static_pages as $item)
        <url>
            <loc>{{route('static-page',  $item->slug) }}</loc>
            <priority>0.5</priority>
            <lastmod>
                {{$item->updated_at->toAtomString()}}
            </lastmod>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach
    @foreach($articles as $item)
        <url>
            <loc>{{route('static-page',  $item->slug) }}</loc>
            <priority>0.5</priority>
            <lastmod>
                {{$item->updated_at->toAtomString()}}
            </lastmod>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach
</urlset>
