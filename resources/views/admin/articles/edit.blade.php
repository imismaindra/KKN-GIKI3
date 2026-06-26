@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('page_title', 'Edit Artikel')

@section('content')
<div class="w-full">
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center space-x-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- FORM PENULISAN (7 Kolom) -->
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" id="articleForm" class="lg:col-span-7 bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Judul Artikel -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Judul Artikel</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required autofocus
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status & Tanggal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-1">Status Publikasi</label>
                    <select name="status" id="status" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Rilis Publikasi</label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                    @error('published_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Thumbnail / Cover Image -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Thumbnail Saat Ini</label>
                <div class="w-48 h-32 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden mb-3">
                    @if($article->thumbnail)
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 font-medium">Belum ada thumbnail</div>
                    @endif
                </div>

                <label for="thumbnail" class="block text-sm font-semibold text-slate-700 mb-1">Ganti Thumbnail (Opsional)</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150 cursor-pointer">
                <p class="text-[10px] text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti. Maksimal 2MB.</p>
                @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- WYSIWYG Editor (Quill) -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Konten / Isi Lengkap Artikel</label>
                <div class="bg-slate-50 rounded-xl border border-slate-250 overflow-hidden">
                    <div id="quillEditor" class="bg-slate-50"></div>
                </div>
                <input type="hidden" name="content" id="contentInput" value="{{ old('content', $article->content) }}">
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- SEPARATOR SEO -->
            <div class="pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-950 uppercase tracking-wider mb-1 flex items-center gap-1.5 text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Optimasi SEO (Search Engine Optimization)</span>
                </h3>
                <p class="text-xs text-slate-400 mb-4">Pengaturan meta tag untuk memaksimalkan peringkat artikel di mesin pencari seperti Google.</p>
            </div>

            <!-- SEO Meta Title -->
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="meta_title" class="block text-sm font-semibold text-slate-700">Meta Title</label>
                    <span class="text-xs text-slate-400 font-medium" id="metaTitleCounter">0 / 60 karakter</span>
                </div>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $article->meta_title) }}" placeholder="Judul khusus hasil pencarian (kosongkan untuk menyamakan dengan judul artikel)"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                <p class="text-[10px] text-slate-400 mt-1">Disarankan antara 50 - 60 karakter. Teks lebih dari ini akan terpotong oleh Google.</p>
                @error('meta_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- SEO Meta Description -->
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="meta_description" class="block text-sm font-semibold text-slate-700">Meta Description</label>
                    <span class="text-xs text-slate-400 font-medium" id="metaDescCounter">0 / 160 karakter</span>
                </div>
                <textarea name="meta_description" id="meta_description" rows="3" placeholder="Ringkasan pendek artikel yang memikat pembaca di Google..."
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">{{ old('meta_description', $article->meta_description) }}</textarea>
                <p class="text-[10px] text-slate-400 mt-1">Ringkasan artikel berkisar 140 - 160 karakter. Bagus untuk memicu klik dari pencari Google.</p>
                @error('meta_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- SEO Meta Keywords -->
            <div>
                <label for="meta_keywords" class="block text-sm font-semibold text-slate-700 mb-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $article->meta_keywords) }}" placeholder="Contoh: berita sekolah, sma giki 3, pondok ramadhan"
                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-800 transition duration-150">
                <p class="text-[10px] text-slate-400 mt-1">Kata kunci pencarian yang relevan dengan isi berita, dipisahkan dengan tanda koma.</p>
                @error('meta_keywords') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-4 border-t border-slate-50">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- PANEL LIVE PREVIEW (5 Kolom - Sticky) -->
        <div class="lg:col-span-5 lg:sticky lg:top-6 space-y-6">
            <!-- Tabs Controls -->
            <div class="bg-white rounded-2xl border border-slate-100 p-2 shadow-sm flex space-x-1">
                <button type="button" id="tabArticleBtn" class="flex-1 py-2 px-3 text-xs font-bold rounded-xl transition bg-slate-900 text-white flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span>Pratinjau Artikel</span>
                </button>
                <button type="button" id="tabSeoBtn" class="flex-1 py-2 px-3 text-xs font-semibold rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>Google SEO Preview</span>
                </button>
            </div>

            <!-- PREVIEW CONTAINER -->
            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                <!-- 1. TAB PRATINJAU ARTIKEL -->
                <div id="previewArticle" class="block">
                    <!-- Header Cover Mockup -->
                    <div class="relative w-full h-48 bg-slate-100 border-b border-slate-100 flex items-center justify-center overflow-hidden">
                        <img id="previewCover" src="{{ $article->thumbnail ? Storage::url($article->thumbnail) : '' }}" class="w-full h-full object-cover {{ $article->thumbnail ? '' : 'hidden' }}" alt="Cover Preview">
                        <div id="previewCoverEmpty" class="text-center p-6 text-slate-400 {{ $article->thumbnail ? 'hidden' : '' }}">
                            <span class="material-symbols-outlined text-4xl mb-1 text-slate-350">image</span>
                            <p class="text-xs font-medium">Belum ada cover diunggah</p>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <span class="px-2.5 py-1 bg-blue-600/90 text-white rounded-lg text-[10px] font-bold uppercase tracking-wider backdrop-blur-sm">
                                BERITA UTAMA
                            </span>
                        </div>
                    </div>

                    <!-- Article Body Preview -->
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-2.5 text-xs text-slate-400 font-medium">
                            <span id="previewDate">{{ $article->published_at ? $article->published_at->format('d M Y') : date('d M Y') }}</span>
                            <span>•</span>
                            <span class="text-blue-600 font-semibold">Oleh Admin</span>
                        </div>

                        <h2 id="previewTitle" class="text-lg font-black text-slate-900 leading-snug">
                            {{ $article->title }}
                        </h2>

                        <!-- Quill Content Output Renderer -->
                        <div class="prose prose-sm max-w-none text-slate-700 min-h-[120px] text-xs leading-relaxed border-t border-slate-50 pt-4" id="previewContent">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>

                <!-- 2. TAB GOOGLE SEO PREVIEW -->
                <div id="previewSeo" class="hidden p-6 space-y-6">
                    <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                        <h4 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span>Simulasi Hasil Pencarian Google</span>
                        </h4>
                        <span class="px-2 py-0.5 bg-emerald-50 border border-emerald-100 text-[10px] font-semibold text-emerald-700 rounded">Desktop</span>
                    </div>

                    <!-- Mock Google Card -->
                    <div class="space-y-1.5 font-sans">
                        <!-- URL & Favicon -->
                        <div class="flex items-center space-x-2 text-xs">
                            <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500 border border-slate-200">
                                S
                            </div>
                            <div class="flex flex-col leading-tight">
                                <span class="text-slate-800 text-xs font-semibold">SMA GIKI 3 SURABAYA</span>
                                <span class="text-slate-400 text-[10px] truncate" id="googlePreviewUrl">https://smagiki3surabaya.sch.id/artikel/{{ $article->slug }}</span>
                            </div>
                        </div>

                        <!-- Clickable Link Title -->
                        <h3 class="text-[19px] text-[#1a0dab] font-normal hover:underline leading-snug cursor-pointer line-clamp-2" id="googlePreviewTitle">
                            {{ $article->meta_title ? $article->meta_title : $article->title }} - SMA GIKI 3 SURABAYA
                        </h3>

                        <!-- Meta Description Snippet -->
                        <p class="text-sm text-[#4d5156] leading-relaxed line-clamp-3" id="googlePreviewDesc">
                            {{ $article->meta_description ? $article->meta_description : strip_tags($article->content) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<style>
    .ql-toolbar.ql-snow {
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        border-color: #cbd5e1;
        background: #ffffff;
    }
    .ql-container.ql-snow {
        border-bottom-left-radius: 0.75rem;
        border-bottom-right-radius: 0.75rem;
        border-color: #cbd5e1;
        background: #f8fafc;
        min-height: 320px;
        font-family: 'Open Sans', ui-sans-serif, system-ui, sans-serif;
    }
    .ql-editor {
        font-size: 0.875rem;
        color: #1e293b;
        line-height: 1.6;
    }
    /* Style preview rich text */
    #previewContent h1 { font-size: 1.5rem; font-weight: 700; margin-top: 1rem; margin-bottom: 0.5rem; }
    #previewContent h2 { font-size: 1.25rem; font-weight: 700; margin-top: 1rem; margin-bottom: 0.5rem; }
    #previewContent h3 { font-size: 1.1rem; font-weight: 700; margin-top: 0.8rem; margin-bottom: 0.4rem; }
    #previewContent p { margin-bottom: 0.75rem; }
    #previewContent ul { list-style-type: disc; padding-left: 1.25rem; margin-bottom: 0.75rem; }
    #previewContent ol { list-style-type: decimal; padding-left: 1.25rem; margin-bottom: 0.75rem; }
    #previewContent blockquote { border-left: 3px solid #cbd5e1; padding-left: 1rem; color: #64748b; font-style: italic; margin-bottom: 0.75rem; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Init Editor Quill.js
        const toolbarOptions = [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['link', 'image'],
            ['clean']
        ];

        const quill = new Quill('#quillEditor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Tulis isi berita atau pengumuman sekolah secara lengkap di sini...'
        });

        // Load existing content
        const savedContent = `{!! old('content', $article->content) !!}`;
        if (savedContent) {
            quill.clipboard.dangerouslyPasteHTML(savedContent);
        }

        // Sinkronisasi Quill HTML ke Hidden Input sebelum Submit
        const form = document.getElementById('articleForm');
        const contentInput = document.getElementById('contentInput');
        form.addEventListener('submit', () => {
            contentInput.value = quill.getSemanticHTML();
        });

        // ==========================================
        // DYNAMIC LIVE PREVIEW LOGIC
        // ==========================================

        const titleInput = document.getElementById('title');
        const metaTitleInput = document.getElementById('meta_title');
        const metaDescInput = document.getElementById('meta_description');
        const thumbnailInput = document.getElementById('thumbnail');

        const previewTitle = document.getElementById('previewTitle');
        const previewContent = document.getElementById('previewContent');
        const previewCover = document.getElementById('previewCover');
        const previewCoverEmpty = document.getElementById('previewCoverEmpty');

        const googlePreviewTitle = document.getElementById('googlePreviewTitle');
        const googlePreviewDesc = document.getElementById('googlePreviewDesc');
        const googlePreviewUrl = document.getElementById('googlePreviewUrl');

        const metaTitleCounter = document.getElementById('metaTitleCounter');
        const metaDescCounter = document.getElementById('metaDescCounter');

        // Helper fungsi pembersih HTML tag untuk Google Description
        function stripHtml(html) {
            let tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }

        // Helper generate slug
        function makeSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Ganti spasi dengan -
                .replace(/[^\w\-]+/g, '')       // Hapus semua char non-word
                .replace(/\-\-+/g, '-')         // Ganti ganda -- dengan tunggal -
                .replace(/^-+/, '')             // Hapus - di awal
                .replace(/-+$/, '');            // Hapus - di akhir
        }

        // Live update fungsi
        function updatePreviews() {
            const titleValue = titleInput.value.trim() || 'Judul artikel akan tampil di sini';
            const metaTitleValue = metaTitleInput.value.trim();
            const metaDescValue = metaDescInput.value.trim();
            const quillHtml = quill.getSemanticHTML();
            const quillPlainText = stripHtml(quillHtml).trim();

            // 1. Update Pratinjau Artikel
            previewTitle.innerText = titleValue;
            if (quillPlainText) {
                previewContent.innerHTML = quillHtml;
            } else {
                previewContent.innerHTML = '<p class="text-slate-400 italic">Konten artikel kosong. Ketik di editor untuk melihat pratinjau langsung...</p>';
            }

            // 2. Update Google SEO Preview
            // URL Slug
            const slug = makeSlug(titleInput.value.trim() || 'judul-artikel');
            googlePreviewUrl.innerText = `https://smagiki3surabaya.sch.id/artikel/${slug}`;

            // Title
            const seoTitle = metaTitleValue ? metaTitleValue : titleValue;
            googlePreviewTitle.innerText = `${seoTitle} - SMA GIKI 3 SURABAYA`;

            // Description
            if (metaDescValue) {
                googlePreviewDesc.innerText = metaDescValue;
            } else if (quillPlainText) {
                googlePreviewDesc.innerText = quillPlainText.substring(0, 160) + (quillPlainText.length > 160 ? '...' : '');
            } else {
                googlePreviewDesc.innerText = 'Ringkasan deskripsi khusus hasil pencarian akan tampil di sini. Jika kosong, Google akan menampilkan potongan konten terformat dari isi artikel.';
            }

            // 3. Update Character Counters
            // Meta Title counter (optimal: 50-60)
            const metaTitleLen = metaTitleValue.length;
            metaTitleCounter.innerText = `${metaTitleLen} / 60 karakter`;
            if (metaTitleLen > 60) {
                metaTitleCounter.className = "text-xs text-red-500 font-bold";
            } else if (metaTitleLen >= 50 && metaTitleLen <= 60) {
                metaTitleCounter.className = "text-xs text-emerald-600 font-bold";
            } else {
                metaTitleCounter.className = "text-xs text-slate-450 font-medium";
            }

            // Meta Description counter (optimal: 140-160)
            const metaDescLen = metaDescValue.length;
            metaDescCounter.innerText = `${metaDescLen} / 160 karakter`;
            if (metaDescLen > 160) {
                metaDescCounter.className = "text-xs text-red-500 font-bold";
            } else if (metaDescLen >= 140 && metaDescLen <= 160) {
                metaDescCounter.className = "text-xs text-emerald-600 font-bold";
            } else {
                metaDescCounter.className = "text-xs text-slate-450 font-medium";
            }
        }

        // Listener events
        titleInput.addEventListener('input', updatePreviews);
        metaTitleInput.addEventListener('input', updatePreviews);
        metaDescInput.addEventListener('input', updatePreviews);
        quill.on('text-change', updatePreviews);

        // Preview Cover Image
        thumbnailInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    previewCover.setAttribute('src', this.result);
                    previewCover.classList.remove('hidden');
                    previewCoverEmpty.classList.add('hidden');
                });
                reader.readAsDataURL(file);
            }
            // If they cancel and we have a database thumbnail, restore it
            else if ("{{ $article->thumbnail }}") {
                previewCover.setAttribute('src', "{{ Storage::url($article->thumbnail) }}");
                previewCover.classList.remove('hidden');
                previewCoverEmpty.classList.add('hidden');
            } else {
                previewCover.classList.add('hidden');
                previewCover.setAttribute('src', '');
                previewCoverEmpty.classList.remove('hidden');
            }
        });

        // Initialize preview on load
        updatePreviews();

        // ==========================================
        // TAB CONTROLLER
        // ==========================================
        const tabArticleBtn = document.getElementById('tabArticleBtn');
        const tabSeoBtn = document.getElementById('tabSeoBtn');
        const previewArticle = document.getElementById('previewArticle');
        const previewSeo = document.getElementById('previewSeo');

        tabArticleBtn.addEventListener('click', () => {
            // Set active button
            tabArticleBtn.className = "flex-1 py-2 px-3 text-xs font-bold rounded-xl transition bg-slate-900 text-white flex items-center justify-center space-x-1.5";
            tabSeoBtn.className = "flex-1 py-2 px-3 text-xs font-semibold rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition flex items-center justify-center space-x-1.5";
            // Show article, hide seo
            previewArticle.classList.remove('hidden');
            previewArticle.classList.add('block');
            previewSeo.classList.remove('block');
            previewSeo.classList.add('hidden');
        });

        tabSeoBtn.addEventListener('click', () => {
            // Set active button
            tabSeoBtn.className = "flex-1 py-2 px-3 text-xs font-bold rounded-xl transition bg-slate-900 text-white flex items-center justify-center space-x-1.5";
            tabArticleBtn.className = "flex-1 py-2 px-3 text-xs font-semibold rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-700 transition flex items-center justify-center space-x-1.5";
            // Show seo, hide article
            previewSeo.classList.remove('hidden');
            previewSeo.classList.add('block');
            previewArticle.classList.remove('block');
            previewArticle.classList.add('hidden');
        });
    });
</script>
@endpush
