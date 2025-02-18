<?php namespace GeneaLabs\LaravelModelCaching\Tests\Feature;

use GeneaLabs\LaravelModelCaching\Tests\FeatureTestCase;
use GeneaLabs\LaravelModelCaching\Tests\Fixtures\Book;

class PaginationTest extends FeatureTestCase
{
    public function testPaginationProvidesDifferentLinksOnDifferentPages()
    {
        // Checking the version start with 10.0.
        if ($this->appVersionTen()) {
            $page1ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>';
            $page2ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">2</span>';
        }

        // Checking the version start with 8.0.
        if ($this->appVersionEightAndNine()) {
            $page1ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>';
            $page2ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">2</span>';
        }

        // Checking the version start with 5.6, 5.7, 5.8, 6 or 7.
        if ($this->appVersionFiveBetweenSeven()) {
            $page1ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
            $page2ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">2</span></li>';
        }

        // Checking the version 5.4 and 5.5
        if ($this->appVersionOld()) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        $book = (new Book)
            ->take(11)
            ->get()
            ->last();
        $page1 = $this->visit("pagination-test");

        $page1->see($page1ActiveLink);
        $page2 = $page1->click("2");
        $page2->see($page2ActiveLink);
        $page2->see($book->title);
    }

    public function testAdvancedPagination()
    {
        // Checking the version start with 10.0.
        if ($this->appVersionTen()) {
            $page1ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>';
            $page2ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">2</span>';
        }

        // Checking the version start with 8.0.
        if ($this->appVersionEightAndNine()) {
            $page1ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>';
            $page2ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">2</span>';
        }

        if ($this->appVersionFiveBetweenSeven()) {
            $page1ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
            $page2ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">2</span></li>';
        }

        if ($this->appVersionOld()) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        $response = $this->visit("pagination-test?page[size]=1");

        $response->see($page1ActiveLink);
    }

    public function testCustomPagination()
    {
        // Checking the version start with 10.0.
        if ($this->appVersionTen()) {
            $page1ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>';
            $page2ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">2</span>';
        }

        // Checking the version start with 8.0.
        if ($this->appVersionEightAndNine()) {
            $page1ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>';
            $page2ActiveLink = '<span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">2</span>';
        }

        if ($this->appVersionFiveBetweenSeven()) {
            $page1ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
            $page2ActiveLink = '<li class="page-item active" aria-current="page"><span class="page-link">2</span></li>';
        }

        if ($this->appVersionOld()) {
            $page1ActiveLink = '<li class="active"><span>1</span></li>';
            $page2ActiveLink = '<li class="active"><span>2</span></li>';
        }

        $response = $this->visit("pagination-test2?custom-page=2");

        $response->see($page2ActiveLink);
    }
}
