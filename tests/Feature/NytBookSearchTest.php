<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NytBookSearchTest extends TestCase
{
    public function test_simple_search()
    {
        $json = json_decode('{
            "status": "OK",
            "copyright": "Copyright (c) 2024 The New York Times Company.  All Rights Reserved.",
            "num_results": 36488,
            "results": [
              {
                "title": "\"I GIVE YOU MY BODY ...\"",
                "description": "The author of the Outlander novels gives tips on writing sex scenes, drawing on examples from the books.",
                "contributor": "by Diana Gabaldon",
                "author": "Diana Gabaldon",
                "contributor_note": "",
                "price": "0.00",
                "age_group": "",
                "publisher": "Dell",
                "isbns": [
                  {
                    "isbn10": "0399178570",
                    "isbn13": "9780399178573"
                  }
                ],
                "ranks_history": [
                  {
                    "primary_isbn10": "0399178570",
                    "primary_isbn13": "9780399178573",
                    "rank": 8,
                    "list_name": "Advice How-To and Miscellaneous",
                    "display_name": "Advice, How-To & Miscellaneous",
                    "published_date": "2016-09-04",
                    "bestsellers_date": "2016-08-20",
                    "weeks_on_list": 1,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  }
                ],
                "reviews": [
                  {
                    "book_review_link": "",
                    "first_chapter_link": "",
                    "sunday_review_link": "",
                    "article_chapter_link": ""
                  }
                ]
              },
              {
                "title": "\"MOST BLESSED OF THE PATRIARCHS\"",
                "description": "A character study that attempts to make sense of Jefferson’s contradictions.",
                "contributor": "by Annette Gordon-Reed and Peter S. Onuf",
                "author": "Annette Gordon-Reed and Peter S Onuf",
                "contributor_note": "",
                "price": "0.00",
                "age_group": "",
                "publisher": "Liveright",
                "isbns": [
                  {
                    "isbn10": "0871404427",
                    "isbn13": "9780871404428"
                  }
                ],
                "ranks_history": [
                  {
                    "primary_isbn10": "0871404427",
                    "primary_isbn13": "9780871404428",
                    "rank": 16,
                    "list_name": "Hardcover Nonfiction",
                    "display_name": "Hardcover Nonfiction",
                    "published_date": "2016-05-01",
                    "bestsellers_date": "2016-04-16",
                    "weeks_on_list": 1,
                    "rank_last_week": 0,
                    "asterisk": 1,
                    "dagger": 0
                  }
                ],
                "reviews": [
                  {
                    "book_review_link": "",
                    "first_chapter_link": "",
                    "sunday_review_link": "",
                    "article_chapter_link": ""
                  }
                ]
              }
            ]
          }', true);

        Http::fake([
            'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=right-key' => Http::response(
                $json,
                200
            ),
        ]);

        $response = $this->json('GET', route('bestsellers'));

        $response->assertStatus(200);
    }

    public function test_search_by_author()
    {
        $json = json_decode('{
            "status": "OK",
            "copyright": "Copyright (c) 2024 The New York Times Company.  All Rights Reserved.",
            "num_results": 53,
            "results": [
              {
                "title": "11/22/63",
                "description": "An English teacher travels back to 1958 by way of a time portal in a Maine diner. His assignment: Stop Lee Harvey Oswald.",
                "contributor": "by Stephen King",
                "author": "Stephen King",
                "contributor_note": "",
                "price": "0.00",
                "age_group": "",
                "publisher": "Pocket Books",
                "isbns": [
                  {
                    "isbn10": "1451627289",
                    "isbn13": "9781451627282"
                  },
                  {
                    "isbn10": "1451627297",
                    "isbn13": "9781451627299"
                  },
                  {
                    "isbn10": "030795143X",
                    "isbn13": "9780307951434"
                  },
                  {
                    "isbn10": "1594135592",
                    "isbn13": "9781594135590"
                  },
                  {
                    "isbn10": "1501120603",
                    "isbn13": "9781501120602"
                  }
                ],
                "ranks_history": [],
                "reviews": [
                  {
                    "book_review_link": "https://www.nytimes.com/2011/10/31/books/stephen-kings-11-23-63-review.html",
                    "first_chapter_link": "",
                    "sunday_review_link": "https://www.nytimes.com/2011/11/13/books/review/11-22-63-by-stephen-king-book-review.html",
                    "article_chapter_link": ""
                  }
                ]
              },
              {
                "title": "AMERICAN VAMPIRE, VOL. 1",
                "description": "What do the roaring 20’s and the wild west have in common? Vampires.",
                "contributor": "by Scott Snyder, Stephen King and Rafael Albuquereque",
                "author": "Scott Snyder, Stephen King and Rafael Albuquereque",
                "contributor_note": "",
                "price": "24.99",
                "age_group": "",
                "publisher": "DC Comics",
                "isbns": [
                  {
                    "isbn10": "1401228305",
                    "isbn13": "9781401228309"
                  }
                ],
                "ranks_history": [],
                "reviews": [
                  {
                    "book_review_link": "",
                    "first_chapter_link": "",
                    "sunday_review_link": "",
                    "article_chapter_link": ""
                  }
                ]
              }
            ]
          }', true);

        Http::fake([
            'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=right-key&author=Stephen King' => Http::response(
                $json,
                200
            ),
        ]);

        $response = $this->json('GET', route('bestsellers'));

        $response->assertStatus(200);
    }

    public function test_search_by_title()
    {
        $json = json_decode('{
            "status": "OK",
            "copyright": "Copyright (c) 2024 The New York Times Company.  All Rights Reserved.",
            "num_results": 1,
            "results": [
              {
                "title": "Song of Susannah (The Dark Tower, Book 6)",
                "description": null,
                "contributor": null,
                "author": "Stephen King",
                "contributor_note": null,
                "price": "0.00",
                "age_group": null,
                "publisher": null,
                "isbns": [
                  {
                    "isbn10": "1416521496",
                    "isbn13": "9781416521495"
                  }
                ],
                "ranks_history": [],
                "reviews": [
                  {
                    "book_review_link": "",
                    "first_chapter_link": null,
                    "sunday_review_link": "https://www.nytimes.com/2004/06/20/books/books-in-brief-fiction-937851.html",
                    "article_chapter_link": null
                  }
                ]
              }
            ]
          }', true);

        $response = $this->json('GET', route('bestsellers'));

        $response->assertStatus(200);
    }

    public function test_search_by_isbn()
    {
        $json = json_decode('{
            "status": "OK",
            "copyright": "Copyright (c) 2024 The New York Times Company.  All Rights Reserved.",
            "num_results": 1,
            "results": [
              {
                "title": "11/22/63",
                "description": "An English teacher travels back to 1958 by way of a time portal in a Maine diner. His assignment: Stop Lee Harvey Oswald.",
                "contributor": "by Stephen King",
                "author": "Stephen King",
                "contributor_note": "",
                "price": "0.00",
                "age_group": "",
                "publisher": "Pocket Books",
                "isbns": [
                  {
                    "isbn10": "1451627289",
                    "isbn13": "9781451627282"
                  },
                  {
                    "isbn10": "1451627297",
                    "isbn13": "9781451627299"
                  },
                  {
                    "isbn10": "030795143X",
                    "isbn13": "9780307951434"
                  },
                  {
                    "isbn10": "1594135592",
                    "isbn13": "9781594135590"
                  },
                  {
                    "isbn10": "1501120603",
                    "isbn13": "9781501120602"
                  }
                ],
                "ranks_history": [
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 13,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-05-08",
                    "bestsellers_date": "2016-04-23",
                    "weeks_on_list": 0,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 15,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-05-01",
                    "bestsellers_date": "2016-04-16",
                    "weeks_on_list": 0,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 14,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-04-24",
                    "bestsellers_date": "2016-04-09",
                    "weeks_on_list": 0,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 12,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-04-17",
                    "bestsellers_date": "2016-04-02",
                    "weeks_on_list": 0,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 7,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-04-10",
                    "bestsellers_date": "2016-03-26",
                    "weeks_on_list": 9,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 6,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-04-03",
                    "bestsellers_date": "2016-03-19",
                    "weeks_on_list": 8,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 7,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-03-27",
                    "bestsellers_date": "2016-03-12",
                    "weeks_on_list": 7,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 8,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-03-20",
                    "bestsellers_date": "2016-03-05",
                    "weeks_on_list": 6,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 7,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-03-13",
                    "bestsellers_date": "2016-02-27",
                    "weeks_on_list": 5,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 15,
                    "list_name": "Combined Print and E-Book Fiction",
                    "display_name": "Combined Print & E-Book Fiction",
                    "published_date": "2016-03-06",
                    "bestsellers_date": "2016-02-20",
                    "weeks_on_list": 19,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 2,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-03-06",
                    "bestsellers_date": "2016-02-20",
                    "weeks_on_list": 4,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 5,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-02-28",
                    "bestsellers_date": "2016-02-13",
                    "weeks_on_list": 3,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 6,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-02-21",
                    "bestsellers_date": "2016-02-06",
                    "weeks_on_list": 2,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1501120603",
                    "primary_isbn13": "9781501120602",
                    "rank": 10,
                    "list_name": "Mass Market Paperback",
                    "display_name": "Paperback Mass-Market Fiction",
                    "published_date": "2016-02-14",
                    "bestsellers_date": "2016-01-30",
                    "weeks_on_list": 1,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1451627297",
                    "primary_isbn13": "9781451627299",
                    "rank": 19,
                    "list_name": "Trade Fiction Paperback",
                    "display_name": "Paperback Trade Fiction",
                    "published_date": "2014-01-05",
                    "bestsellers_date": "2013-12-21",
                    "weeks_on_list": 18,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1451627297",
                    "primary_isbn13": "9781451627299",
                    "rank": 16,
                    "list_name": "Trade Fiction Paperback",
                    "display_name": "Paperback Trade Fiction",
                    "published_date": "2013-12-29",
                    "bestsellers_date": "2013-12-14",
                    "weeks_on_list": 17,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1451627297",
                    "primary_isbn13": "9781451627299",
                    "rank": 16,
                    "list_name": "Trade Fiction Paperback",
                    "display_name": "Paperback Trade Fiction",
                    "published_date": "2013-12-22",
                    "bestsellers_date": "2013-12-07",
                    "weeks_on_list": 16,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1451627297",
                    "primary_isbn13": "9781451627299",
                    "rank": 21,
                    "list_name": "Trade Fiction Paperback",
                    "display_name": "Paperback Trade Fiction",
                    "published_date": "2013-12-15",
                    "bestsellers_date": "2013-11-30",
                    "weeks_on_list": 0,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "None",
                    "primary_isbn13": "9781451627305",
                    "rank": 4,
                    "list_name": "Combined Print and E-Book Fiction",
                    "display_name": "Combined Print & E-Book Fiction",
                    "published_date": "2013-12-08",
                    "bestsellers_date": "2013-11-23",
                    "weeks_on_list": 18,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  },
                  {
                    "primary_isbn10": "1451627297",
                    "primary_isbn13": "9781451627299",
                    "rank": 24,
                    "list_name": "Trade Fiction Paperback",
                    "display_name": "Paperback Trade Fiction",
                    "published_date": "2013-12-08",
                    "bestsellers_date": "2013-11-23",
                    "weeks_on_list": 0,
                    "rank_last_week": 0,
                    "asterisk": 0,
                    "dagger": 0
                  }
                ],
                "reviews": [
                  {
                    "book_review_link": "https://www.nytimes.com/2011/10/31/books/stephen-kings-11-23-63-review.html",
                    "first_chapter_link": "",
                    "sunday_review_link": "https://www.nytimes.com/2011/11/13/books/review/11-22-63-by-stephen-king-book-review.html",
                    "article_chapter_link": ""
                  }
                ]
              }
            ]
          }', true);

        Http::fake([
            'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=right-key&isbn=1451627289' => Http::response(
                $json,
                200
            ),
        ]);

        $response = $this->json('GET', route('bestsellers'));

        $response->assertStatus(200);
    }

    public function test_search_by_isbns()
    {
        $json = json_decode('{
            "status": "OK",
            "copyright": "Copyright (c) 2024 The New York Times Company.  All Rights Reserved.",
            "num_results": 53,
            "results": [
              {
                "title": "11/22/63",
                "description": "An English teacher travels back to 1958 by way of a time portal in a Maine diner. His assignment: Stop Lee Harvey Oswald.",
                "contributor": "by Stephen King",
                "author": "Stephen King",
                "contributor_note": "",
                "price": "0.00",
                "age_group": "",
                "publisher": "Pocket Books",
                "isbns": [
                  {
                    "isbn10": "1451627289",
                    "isbn13": "9781451627282"
                  },
                  {
                    "isbn10": "1451627297",
                    "isbn13": "9781451627299"
                  },
                  {
                    "isbn10": "030795143X",
                    "isbn13": "9780307951434"
                  },
                  {
                    "isbn10": "1594135592",
                    "isbn13": "9781594135590"
                  },
                  {
                    "isbn10": "1501120603",
                    "isbn13": "9781501120602"
                  }
                ],
                "ranks_history": [],
                "reviews": [
                  {
                    "book_review_link": "https://www.nytimes.com/2011/10/31/books/stephen-kings-11-23-63-review.html",
                    "first_chapter_link": "",
                    "sunday_review_link": "https://www.nytimes.com/2011/11/13/books/review/11-22-63-by-stephen-king-book-review.html",
                    "article_chapter_link": ""
                  }
                ]
              },
              {
                "title": "A FACE IN THE CROWD",
                "description": "An elderly widower watches baseballt to distract himself from his wife\'s death, but figures from his past appear every night in the seat behind home plate; a Kindle single.",
                "contributor": "by Stephen King and Stewart O\'Nan",
                "author": "Stephen King and Stewart O\'Nan",
                "contributor_note": "",
                "price": "0.00",
                "age_group": "",
                "publisher": "Scribner",
                "isbns": [
                  {
                    "isbn10": "1476713340",
                    "isbn13": "9781476713342"
                  }
                ],
                "ranks_history": [],
                "reviews": [
                  {
                    "book_review_link": "",
                    "first_chapter_link": "",
                    "sunday_review_link": "",
                    "article_chapter_link": ""
                  }
                ]
              }', true);

        Http::fake([
            'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?api-key=right-key&isbn=1451627289;9781476713342' => Http::response(
                $json,
                200
            ),
        ]);

        $response = $this->json('GET', route('bestsellers'));

        $response->assertStatus(200);
    }

    public function test_invalid_isbn()
    {
        $response = $this->json('GET', route('bestsellers'), ['isbn' => '04991785711']);
        $response->assertJsonValidationErrors(['isbn']);
    }

    public function test_invalid_offset()
    {
        $response = $this->json('GET', route('bestsellers'), ['offset' => 10]);
        $response->assertJsonValidationErrors(['offset']);
    }
}
