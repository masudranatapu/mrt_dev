@extends('backend.layouts.app')

@section('title', __('Page SEO'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/image_uploader/image-uploader.css') }}">
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            {{ __('Page SEO Settings') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-1">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills border">
                                    <button class="nav-link active mb-2" data-bs-toggle="pill" data-bs-target="#home">
                                        <i class="menu-icon bx bx-home"></i>
                                        {{ __('Home') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#about">
                                        <i class="menu-icon bx bx-info-circle"></i>
                                        {{ __('About') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#contact">
                                        <i class="menu-icon bx bx-phone"></i>
                                        {{ __('Contact') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#blog">
                                        <i class="menu-icon bx bx-book"></i>
                                        {{ __('Blog') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#privacy">
                                        <i class="menu-icon bx bx-lock"></i>
                                        {{ __('Privacy') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#terms">
                                        <i class="menu-icon bx bx-file"></i>
                                        {{ __('Terms') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#career">
                                        <i class="menu-icon bx bx-briefcase"></i>
                                        {{ __('Career') }}
                                    </button>
                                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#common">
                                        <i class="menu-icon bx bx-copy"></i>
                                        {{ __('Common SEO') }}
                                    </button>
                                </div>
                            </div>

                            <!-- RIGHT CONTENT -->
                            <div class="col-md-9">
                                <div class="tab-content border p-3">
                                    {{-- home  --}}
                                    <div class="tab-pane fade show active" id="home">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="home">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Home Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="home_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Home Description') }}">{{ $pageSeo->home_description }}</textarea>
                                                    @error('home_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Home Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="home_keywords"
                                                        value="{{ $pageSeo->home_keywords }}"
                                                        placeholder="Enter Open Graph Title">
                                                    @error('home_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Home Robots') }}
                                                    </label>
                                                    <select name="home_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->home_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->home_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('home_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Home Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control" name="home_canonical_url"
                                                        value="{{ $pageSeo->home_canonical_url }}"
                                                        placeholder="Home Canonical URL">
                                                    @error('home_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- about --}}
                                    <div class="tab-pane fade" id="about">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="about">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('About Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="about_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('About Description') }}">{{ $pageSeo->about_description }}</textarea>
                                                    @error('about_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('About Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="about_keywords"
                                                        value="{{ $pageSeo->about_keywords }}"
                                                        placeholder="{{ __('About keywords') }}">
                                                    @error('about_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('About Robots') }}
                                                    </label>
                                                    <select name="about_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->about_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->about_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('about_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('About Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control" name="about_canonical_url"
                                                        value="{{ $pageSeo->about_canonical_url }}"
                                                        placeholder="{{ __('About Canonical URL') }}">
                                                    @error('about_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- contact --}}
                                    <div class="tab-pane fade" id="contact">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="contact">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Contact Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="contact_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Contact Description') }}">{{ $pageSeo->contact_description }}</textarea>
                                                    @error('contact_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Contact Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="contact_keywords"
                                                        value="{{ $pageSeo->contact_keywords }}"
                                                        placeholder="{{ __('Contact keywords') }}">
                                                    @error('contact_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Contact Robots') }}
                                                    </label>
                                                    <select name="contact_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->contact_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->contact_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('contact_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Contact Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        name="contact_canonical_url"
                                                        value="{{ $pageSeo->contact_canonical_url }}"
                                                        placeholder="{{ __('Contact Canonical URL') }}">
                                                    @error('contact_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- blog --}}
                                    <div class="tab-pane fade" id="blog">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="blog">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Blog Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="blog_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Blog Description') }}">{{ $pageSeo->blog_description }}</textarea>
                                                    @error('blog_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Blog Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="blog_keywords"
                                                        value="{{ $pageSeo->blog_keywords }}"
                                                        placeholder="{{ __('Blog keywords') }}">
                                                    @error('blog_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Blog Robots') }}
                                                    </label>
                                                    <select name="blog_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->blog_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->blog_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('blog_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Blog Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control" name="blog_canonical_url"
                                                        value="{{ $pageSeo->blog_canonical_url }}"
                                                        placeholder="{{ __('Blog Canonical URL') }}">
                                                    @error('blog_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- privacy  --}}
                                    <div class="tab-pane fade" id="privacy">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="privacy">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Privacy Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="privacy_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Privacy Description') }}">{{ $pageSeo->privacy_description }}</textarea>
                                                    @error('privacy_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Privacy Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="privacy_keywords"
                                                        value="{{ $pageSeo->privacy_keywords }}"
                                                        placeholder="{{ __('Privacy keywords') }}">
                                                    @error('privacy_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Privacy Robots') }}
                                                    </label>
                                                    <select name="privacy_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->privacy_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->privacy_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('privacy_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Privacy Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        name="privacy_canonical_url"
                                                        value="{{ $pageSeo->privacy_canonical_url }}"
                                                        placeholder="{{ __('Privacy Canonical URL') }}">
                                                    @error('privacy_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- terms --}}
                                    <div class="tab-pane fade" id="terms">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="terms">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Terms Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="terms_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Terms Description') }}">{{ $pageSeo->terms_description }}</textarea>
                                                    @error('terms_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Terms Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="terms_keywords"
                                                        value="{{ $pageSeo->terms_keywords }}"
                                                        placeholder="{{ __('Terms keywords') }}">
                                                    @error('terms_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Terms Robots') }}
                                                    </label>
                                                    <select name="terms_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->terms_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->terms_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('terms_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Terms Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control" name="terms_canonical_url"
                                                        value="{{ $pageSeo->terms_canonical_url }}"
                                                        placeholder="{{ __('Terms Canonical URL') }}">
                                                    @error('terms_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- career  --}}
                                    <div class="tab-pane fade" id="career">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="page_type" value="career">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Career Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="career_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Career Description') }}">{{ $pageSeo->career_description }}</textarea>
                                                    @error('career_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Career Keywords') }}
                                                        <span class="text-danger">*</span>
                                                        <small class="text-warning">
                                                            {{ __('Use a comma (,) at the end of each word.') }}
                                                        </small>
                                                    </label>
                                                    <input type="text" class="form-control" name="career_keywords"
                                                        value="{{ $pageSeo->career_keywords }}"
                                                        placeholder="{{ __('Career keywords') }}">
                                                    @error('career_keywords')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Career Robots') }}
                                                    </label>
                                                    <select name="career_robots" class="form-control">
                                                        <option value="index"
                                                            @if ($pageSeo->career_robots == 'index') selected @endif>
                                                            {{ __('Index') }}
                                                        </option>
                                                        <option value="follow"
                                                            @if ($pageSeo->career_robots == 'follow') selected @endif>
                                                            {{ __('Follow') }}
                                                        </option>
                                                    </select>
                                                    @error('career_robots')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Career Canonical_url') }}
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        name="career_canonical_url"
                                                        value="{{ $pageSeo->career_canonical_url }}"
                                                        placeholder="{{ __('Career Canonical URL') }}">
                                                    @error('career_canonical_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- common --}}
                                    <div class="tab-pane fade" id="common">
                                        <form action="{{ route('admin.page-seo.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="page_type" value="common">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Author') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="author" value="{{ $pageSeo->author }}"
                                                        class="form-control" placeholder="{{ __('Author') }}">
                                                    @error('author')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Open Graph Site Name') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Open Graph Site Name') }}"
                                                        name="og_site_name" value="{{ $pageSeo->og_site_name }}">
                                                    @error('og_site_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Open Graph Title') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="og_title" class="form-control"
                                                        value="{{ $pageSeo->og_title }}"
                                                        placeholder="{{ __('Open Graph Title') }}">
                                                    @error('og_title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Open Graph Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="og_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Open Graph Description') }}">{{ $pageSeo->og_description }}</textarea>
                                                    @error('og_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Open Graph Type') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Open Graph Type') }}" name="og_type"
                                                        value="{{ $pageSeo->og_type }}">
                                                    @error('og_type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Open Graph URL') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Open Graph URL') }}" name="og_url"
                                                        value="{{ $pageSeo->og_url }}">
                                                    @error('og_url')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Open Graph Image') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="ogImage"></div>
                                                    @error('og_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Twitter Card') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Twitter Card') }}" name="twitter_card"
                                                        value="{{ $pageSeo->twitter_card }}">
                                                    @error('twitter_card')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Twitter Title') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Twitter Title') }}" name="twitter_title"
                                                        value="{{ $pageSeo->twitter_title }}">
                                                    @error('twitter_title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Twitter Description') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="twitter_description" class="form-control" cols="30" rows="5"
                                                        placeholder="{{ __('Twitter Description') }}">{{ $pageSeo->twitter_description }}</textarea>
                                                    @error('twitter_description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Twitter Image') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="twitterImage"></div>
                                                    @error('twitter_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/image_uploader/image-uploader.js') }}"></script>

    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });

        var showOgImage = @json(formatImagePath($pageSeo->id, $pageSeo->og_image));
        $('.ogImage').imageUploader({
            preloaded: showOgImage,
            imagesInputName: 'og_image',
            maxFiles: 1,
            isMultiple: false,
        });
        var showTwitterImage = @json(formatImagePath($pageSeo->id, $pageSeo->twitter_image));
        $('.twitterImage').imageUploader({
            preloaded: showTwitterImage,
            imagesInputName: 'twitter_image',
            maxFiles: 1,
            isMultiple: false,
        });
    </script>
@endpush
