<?php

namespace Database\Seeders;

use App\Models\PageMetaSeo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageMetaSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->pageMetaSeoSetting();
            DB::commit();
            $this->command->info('Page meta SEO successfully seeded.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    private function pageMetaSeoSetting()
    {
        $pageMetaSeo = PageMetaSeo::query()
            ->firstOrCreate();
        // home
        $pageMetaSeo->home_title = '';
        $pageMetaSeo->home_description = '';
        $pageMetaSeo->home_keywords = '';
        $pageMetaSeo->home_robots = 'index';
        $pageMetaSeo->home_canonical_url = '';
        // about
        $pageMetaSeo->about_title = '';
        $pageMetaSeo->about_description = '';
        $pageMetaSeo->about_keywords = '';
        $pageMetaSeo->about_robots = 'index';
        $pageMetaSeo->about_canonical_url = '';
        // contact
        $pageMetaSeo->contact_title = '';
        $pageMetaSeo->contact_description = '';
        $pageMetaSeo->contact_keywords = '';
        $pageMetaSeo->contact_robots = 'index';
        $pageMetaSeo->contact_canonical_url = '';
        // blog
        $pageMetaSeo->blog_title = '';
        $pageMetaSeo->blog_description = '';
        $pageMetaSeo->blog_keywords = '';
        $pageMetaSeo->blog_robots = 'index';
        $pageMetaSeo->blog_canonical_url = '';
        // privacy
        $pageMetaSeo->privacy_title = '';
        $pageMetaSeo->privacy_description = '';
        $pageMetaSeo->privacy_keywords = '';
        $pageMetaSeo->privacy_robots = 'index';
        $pageMetaSeo->privacy_canonical_url = '';
        // faq
        $pageMetaSeo->faq_title = '';
        $pageMetaSeo->faq_description = '';
        $pageMetaSeo->faq_keywords = '';
        $pageMetaSeo->faq_robots = 'index';
        $pageMetaSeo->faq_canonical_url = '';
        // terms
        $pageMetaSeo->terms_title = '';
        $pageMetaSeo->terms_description = '';
        $pageMetaSeo->terms_keywords = '';
        $pageMetaSeo->terms_robots = 'index';
        $pageMetaSeo->terms_canonical_url = '';
        // project
        $pageMetaSeo->project_title = '';
        $pageMetaSeo->project_description = '';
        $pageMetaSeo->project_keywords = '';
        $pageMetaSeo->project_robots = 'index';
        $pageMetaSeo->project_canonical_url = '';
        // common
        $pageMetaSeo->author = '';
        $pageMetaSeo->language = '';
        $pageMetaSeo->revisit_after = '';
        $pageMetaSeo->theme_color = '';
        $pageMetaSeo->geo_region = '';
        $pageMetaSeo->geo_placename = '';
        // og
        $pageMetaSeo->og_title = '';
        $pageMetaSeo->og_description = '';
        $pageMetaSeo->og_type = '';
        $pageMetaSeo->og_url = '';
        $pageMetaSeo->og_image = '';
        $pageMetaSeo->og_site_name = '';
        // twitter
        $pageMetaSeo->twitter_card = '';
        $pageMetaSeo->twitter_url = '';
        $pageMetaSeo->twitter_title = '';
        $pageMetaSeo->twitter_description = '';
        $pageMetaSeo->twitter_image = '';

        $pageMetaSeo->save();
        return true;
    }
}
