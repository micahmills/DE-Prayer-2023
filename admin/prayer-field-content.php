<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

//wp i18n make-pot . languages/default.pot --skip-audit --subtract="languages/terms-to-exclude.pot"

class P4_Ramadan_2023_Content {
    public static function content( $language, $names, $from_translation = 'en_US' ) {
//        $values = p4r_porch_fields();
//        $fields = [
//            'location_name' => $names['location_name'],
//            'people_name' => $names['people_plural_masculine'],
//            'people_singular_masculine' => $names['people_singular_masculine'],
//            'people_singular_feminine' => $names['people_singular_feminine'],
//            'people_plural_masculine' => $names['people_plural_masculine'],
//            'people_plural_feminine' => $names['people_plural_feminine'],
//        ];

        $fields = [];
        add_filter( 'determine_locale', function ( $locale ) use ( $from_translation ) {
            if ( ! empty( $from_translation ) ) {
                return $from_translation;
            }
            return $locale;
        }, 1001, 1 );
        if ( $from_translation !== 'en_US' ){
            load_plugin_textdomain( 'ramadan-2023', false, trailingslashit( dirname( plugin_basename( __FILE__ ), 2 ) ). 'support/languages' );
        }

        $data = [
            [
                __( 'God, we love you! As your Church help us do what it takes to let the people [of location] see you through Jesus, the radiance of your glory, the exact imprint of your nature! (Hebrews 1:3)', 'ramadan-2023' ),
                __( '"I am twenty-four and from Tunisia. I had a lot of debt and owed a lot of people and the government money. I asked myself, "Why don\'t I ask God to help me?" The truth is, I didn\'t ask because I didn\'t believe God would help me. I left Islam and called myself an atheist. But, there was always something inside me that said, "There is a God." I began to search and discuss with my friends. At that time, all of us were disillusioned, searching for truth, and some had even become Christians. We all brought information and shared with one another. Pray for us that we will discover truth together."

Pray for spiritual seekers [in X] and all over the Muslim world to search and discuss the Bible with friends.', 'ramadan-2023' ),
                __( '“When an attempt was made by both Gentiles and Jews, with their rulers, to mistreat them and to stone them, they learned of it and fled to Lystra and Derbe, cities of Lycaonia, and to the surrounding country, and there they continued to preach the gospel.” (Acts 14:5-7).                                                                                                                                                      When attempts are made to mistreat believers [in location] - and even when some must flee - may they be blessed with the boldness and perseverance to continue to preach the gospel. (Acts 14:5-7) Lord, give them faith that persecution cannot shake.” (Acts 14:5-7). 
When attempts are made to mistreat believers in Tunisia - and even when some must flee - may they be blessed with the boldness and perseverance to continue to preach the gospel. (Acts 14:5-7) Lord, give them faith that persecution cannot shake.', 'ramadan-2023' ),
                __( 'How does this video lead you to pray', 'ramadan-2023' ),
                __( '"This is the grand purpose for which we were created: to enjoy the grace of Christ as we spread the gospel of Christ from wherever we live, to the ends of the earth." - David Platt', 'ramadan-2023' ),
            ],
            [
                __( 'God, we love you! As your Church help us do what it takes to gladden the hearts of [people_name] as they understand that Jesus completely and perfectly made purification for sin, and then you sat down at the right hand of Majesty! (Hebrews 1:3-4)', 'ramadan-2023' ),
                __( 'Testimony from Senegal.
"Jane" found herself pregnant as a teenager and so somehow gave her self an abortion.  A few years later, she was pregnant again.  This time she decided to keep the baby, but in order to avoid shaming the family, her parents forced her to abort.  She was 5 months along, and the baby was born alive.  Her mother showed her the baby, and then buried it alive.  And Jane lived in the grief and anger and bitterness that followed this event.

On Thursday night she walked through forgiveness with the team teaching soul care. It was HARD. There were tears, but Jesus brought beautiful freedom to her life.

Pray for spiritual seekers in _________ and all over the Muslim world to search and discuss the Bible with friends.', 'ramadan-2023' ),
                __( '“So Peter was kept in prison, but earnest prayer for him was made to God by the church.” (Acts 12:5 ESV).
When the church [in location] is persecuted, and even when followers of Jesus are imprisoned, may the church be drawn into earnest, persevering prayer. (Acts 12:5) Lord Jesus, deepen the faith and sustain the dependent prayers of the church [in location].', 'ramadan-2023' ),
                __( 'How does this video lead you to pray', 'ramadan-2023' ),
                __( '“There is not a square inch in the whole domain of our human existence over which Christ, who is Sovereign over all, does not cry, Mine!” - Abraham Kuyper', 'ramadan-2023' ),
            ],

        ];


        function ramadan_format_message( $message, $fields ) {
            $message = make_clickable( $message );
            $message = str_replace( '[people_singular_masculine]', !empty( $fields['people_singular_masculine'] ) ? $fields['people_singular_masculine'] : '[people_singular_masculine]', $message );
            $message = str_replace( '[people_singular_feminine]', !empty( $fields['people_singular_feminine'] ) ? $fields['people_singular_feminine'] : '[people_singular_feminine]', $message );
            $message = str_replace( '[people_plural_masculine]', !empty( $fields['people_plural_masculine'] ) ? $fields['people_plural_masculine'] : '[people_plural_masculine]', $message );
            $message = str_replace( '[people_plural_feminine]', !empty( $fields['people_plural_feminine'] ) ? $fields['people_plural_feminine'] : '[people_plural_feminine]', $message );
            $message = str_replace( '[people_name]', !empty( $fields['people_name'] ) ? $fields['people_name'] : '[people_name]', $message );
            $message = str_replace( '[location_name]', !empty( $fields['location_name'] ) ? $fields['location_name'] : '[location_name]', $message );
            return $message;
        }

        $content = [];
        foreach ( $data as $d ){

            $content[] = [
                'excerpt' => wp_kses_post( ramadan_format_message( $d[0], $fields ) ),
                'content' => [
                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'PRAISE', 'ramadan-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[0], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'KINGDOM COME', 'ramadan-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[1], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'PRAY THE BOOK OF ACTS', 'ramadan-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[2], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'PRAY THE HALL OF FAITH', 'ramadan-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[3], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'PRAYER', 'ramadan-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[4], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',
                ]
            ];
        }
        return $content;
    }
}