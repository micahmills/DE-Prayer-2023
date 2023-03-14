<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

//wp i18n make-pot . languages/default.pot --skip-audit --subtract="languages/terms-to-exclude.pot"

class P4_Ramadan_2023_Content {

    public static function install_content( $language = 'en_US', $names = [], $from_translation = null ) {
        $campaign = DT_Campaign_Settings::get_campaign();
        if ( empty( $campaign ) ) {
            dt_write_log( 'Campaign not set' );
            return false;
        }
        $start = $campaign['start_date']['formatted'] ?? '';
        if ( empty( $start ) ) {
            dt_write_log( 'Start date not set' );
            return false;
        }

        $installed = [];
        $content = self::content( $language, $names, $from_translation ?? $language );
        foreach ( $content as $i => $day ) {

            $title = gmdate( 'F j Y', strtotime( $start . ' + ' . $i . ' day' ) );
            $date = gmdate( 'Y-m-d', strtotime( $start . ' + ' . $i . ' day' ) );
            $slug = str_replace( ' ', '-', strtolower( gmdate( 'F j Y', strtotime( $start . ' + ' . $i . ' day' ) ) ) );
            $post_content = implode( '', wp_unslash( $day['content'] ) );

//            $day = DT_Campaign_Settings::what_day_in_campaign( $post_date );

            $args = [
                'post_title'    => $title,

                'post_content'  => $post_content,
                'post_excerpt'  => $day['excerpt'],
                'post_type'  => PORCH_LANDING_POST_TYPE,
                'post_status'   => 'publish',
                'post_author'   => get_current_user_id(),
                'meta_input' => [
                    PORCH_LANDING_META_KEY => $slug,
                    'post_language' => $language,
                    'day' => $i + 1,
                    'fuel_tag' => 'ramadan_2023',
                    'linked_campaign' => $campaign['ID'],
                ]
            ];

            $installed[] = wp_insert_post( $args );

        }

        return $installed;
    }

    public static function content( $language, $names, $from_translation = 'en_US' ) {

        $fields = $names;
        add_filter( 'determine_locale', function ( $locale ) use ( $from_translation ) {
            if ( ! empty( $from_translation ) ) {
                return $from_translation;
            }
            return $locale;
        }, 1001, 1 );
        if ( $from_translation !== 'en_US' ){
            load_plugin_textdomain( 'ramadan-2023', false, trailingslashit( dirname( plugin_basename( __FILE__ ), 2 ) ) . 'languages' );
        }

        $data = [
            [
                //day 1
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] see you through Jesus, the radiance of your glory, the exact imprint of your nature! (Hebrews 1:3)', 'de-prayer-2023' ),
                __( '"I am twenty-four and from Tunisia. I had a lot of debt and owed a lot of people and the government money. I asked myself, "Why don\'t I ask God to help me?" The truth is, I didn\'t ask because I didn\'t believe God would help me. I left Islam and called myself an atheist. But, there was always something inside me that said, "There is a God." I began to search and discuss with my friends. At that time, all of us were disillusioned, searching for truth, and some had even become Christians. We all brought information and shared with one another. Pray for us that we will discover truth together."

Pray for spiritual seekers [in location] and all over the Muslim world to search and discuss the Bible with friends.', 'de-prayer-2023' ),
                __( '“When an attempt was made by both Gentiles and Jews, with their rulers, to mistreat them and to stone them, they learned of it and fled to Lystra and Derbe, cities of Lycaonia, and to the surrounding country, and there they continued to preach the gospel.” (Acts 14:5-7).

When attempts are made to mistreat believers [in location] - and even when some must flee - may they be blessed with the boldness and perseverance to continue to preach the gospel. (Acts 14:5-7) Lord, give them faith that cannot be shaken by persecution."', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"This is the grand purpose for which we were created: to enjoy the grace of Christ as we spread the gospel of Christ from wherever we live, to the ends of the earth." - David Platt ', 'de-prayer-2023' ),
            ],
            [
                //day 2
                __( 'God, we love you! As your Church, help us do what it takes to gladden the hearts of your people [in location] as they understand that Jesus completely and perfectly made purification for sin and then sat down at the right hand of Majesty! (Hebrews 1:3-4)', 'de-prayer-2023' ),
                __( 'I am Abraham and I grew up in a Muslim family in India. The doctor said the baby inside my pregnant wife would die. Followers of Jesus offered to pray for our unborn child. Jesus miraculously healed our baby. After this our family began listening to stories about Jesus. Today we passionately make disciples of Jesus among other Muslims in India. As we prepared to baptize other families they shared how because of following Jesus their lives are in springtime. Jesus has healed them of sickness, given them hope and improved their families. Yet most people groups in India remain unreached by the gospel.  Pray that God\'s kingdom comes to [in location] and all over the Muslim world.', 'de-prayer-2023' ),
                __( '“So Peter was kept in prison, but earnest prayer for him was made to God by the church.” (Acts 12:5 ESV).

When the church [in location] is persecuted, and even when followers of Jesus are imprisoned, may the church be drawn into earnest, persevering prayer. (Acts 12:5) Lord Jesus, deepen the faith and sustain the dependent prayers of the church [in location]."', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“There is not a square inch in the whole domain of our human existence over which Christ, who is Sovereign over all, does not cry, Mine!” - Abraham Kuyper', 'de-prayer-2023' ),
            ],
            [
                //day 3
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that when Jesus taught us to pray to you He told us to call you our Father! (Matthew 6:6-14)', 'de-prayer-2023' ),
                __( 'Fawad saw a Facebook ad one day about the prophet Abraham ready to sacrifice his son. He had questions and he reached out to a Christian social media page. He engaged in many conversations. After talking for three months he decided to put his faith in Jesus. Fawad did something bold after he became a believer, he invited his family members to listen to his conversation on the phone with a Christian. His wife and kids sat with him when he would talk about Jesus and after a couple of months they all made a decision to follow in Fawad’s footsteps and be followers of Jesus. Please pray for Fawad, his wife and three kids to grow stronger in their faith and continue to be bold to share their faith with many others. Pray for more families like Fawad\'s [in location].', 'de-prayer-2023' ),
                __( '“but you shall cling to the Lord your God just as you have done to this day.” (Joshua 23:8 ESV).
Strengthen the spiritual hands of believers [in location] that they might cling to the Lord their God. (Joshua 23:8) 

Grant, the church [in location] an ever-growing list of those who have gone ahead to which they can look for example and encouragement in faithful finishing of the race (2 Timothy 4:7).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“Never pity missionaries; envy them. They are where the real action is — where life and death, sin and grace, Heaven and Hell converge.” - Robert C. Shannon', 'de-prayer-2023' ),
            ],
            [
                //day 4
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus\' cross was the one place in the world\'s history in which your Father\'s justice AND mercy were simultaneously fulfilled as He was marred beyond human semblance, despised, rejected, sorrowful, acquainted with grief, smitten, afflicted, pierced, crushed, chastised, and anguished (Isaiah 52-53) so that WE don\'t have to be.', 'de-prayer-2023' ),
                __( 'Sakib was born in a Muslim family but had many doubts about his religion. He found the truth in the Holy Bible. He said, “Now it is my responsibility to call my family and people in my area to the path of truth, for the [Holy Bible] is an ideal medium.” He is now interested to start learning much more about the Bible. Pray for Sakib and multitudes of others around the Muslim world who are being tranformed through the Living Word of God. ', 'de-prayer-2023' ),
                __( '“Their idols are like scarecrows in a cucumber field, and they cannot speak; they have to be carried, for they cannot walk. Do not be afraid of them, for they cannot do evil, neither is it in them to do good.” (Jeremiah 10:5 ESV). 

May the idols of culture [in location] be revealed for the unspeaking, unmoving frauds that they are, and may the church have the clarity and wisdom to address idolatry in all of its forms. (Jeremiah 10:5) Lord God, would you grant believers [in location] humility, gentleness, and discernment as they fight idolatry in community.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"We must be global Christians with a global vision because our God is a global God." - John Stott', 'de-prayer-2023' ),
            ],
            [
                //day 5
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we receive grace IN Christ! (1 Corinthians 1:4)', 'de-prayer-2023' ),
                __( 'Jannat had a question for a Christian she was talking to: "I read some parts of the Bible, and there I found that Jesus came only for the Jews, but it also says when He was crucified that He is the savior of mankind. Do you have any proof of this?”
 
A long discussion ensued about many passages in the Bible. After a few days, Jannat asked her friend to send Bible references proving that Islam is not true.  After long days of discussions, she started to believe in Jesus but not that He is the Son of God. Eventually, Jannat asked for a New Testament. Jannat asks for prayer for herself because though she is still on the journey to Christ, her family notices changes in her behavior and are causing her problems because of it. 

Pray for Jannat and many seekers all over the Muslim world to have grace and wisdom to discern who in their family would be open to discovering God through the teachings of the Bible so that they can come to faith in Christ with others. ', 'de-prayer-2023' ),
                __( '“For we who have believed enter that rest, as he has said, “As I swore in my wrath, ‘They shall not enter my rest,’” although his works were finished from the foundation of the world.” (Hebrews 4:3 ESV).

Creator God, your work of drawing every nation on earth to yourself was finished from the foundation of the world. (Hebrews 4:3) May the glory of your finished work and your eternal wisdom flood the church [in location] with boldness and satisfaction with all that you\'ve done, are doing, and will do among all the tribes and tongues [of location] and the whole earth.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"We talk of the second coming; half the world has never heard of the first." - Oswald J. Smith', 'de-prayer-2023' ),
            ],
            [
                //day 6
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that our redemption is IN Christ! (Romans 3:24)', 'de-prayer-2023' ),
                __( 'My name is Khalid and I am a follower of Jesus in Morocco. My abusive Father died this year and I am the oldest in my family. It is my job to care for my mother and my siblings. I want to do much more than my cultural duty for my family. As a follower of Jesus, I want to love them well. My mother has been telling me the change she has noticed in me and what a good son I am. I know this is because of Jesus but she does not yet know this. I have been talking to her about living my life fully surrendered to God. I am finding ways to share verses that help us as a family know God’s love and truth together. Pray for me and my family as I bring them on a journey of discovering who God is and how we, as a family, can live our lives in full knowledge of Him and surrender to Him. Pray for believers [in location] who, like Khalid, are trying to lead their family on a journey to Christ.', 'de-prayer-2023' ),
                __( '“He who testifies to these things says, “Surely I am coming soon.” Amen. Come, Lord Jesus!” (Revelation 22:20 ESV).

Lord Jesus, would you write the maranatha cry on the hearts of the church [in location] such that their lives and their words would raise up a shout in harmony: "Come, Lord Jesus!" (Revelation 22:20) Grant each follower [in location] eternal hope in the glory of your return.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"Some wish to live within the sound of a chapel bell; I wish to run a rescue mission within a yard of hell." - C. T. Studd', 'de-prayer-2023' ),
            ],
            [
                //day 7
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we are justified IN Christ! (Galatians 2:17)', 'de-prayer-2023' ),
                __( 'Malik is a 49 year old man from Gilgit Baltistan area. He had a lot of doubts about Islam that led him to explore Christianity. He shared that he had a very hard time finding evidence of any miracles Mohammad performed. One of the popular miracles Mohammad performed was splitting the moon in half. The more he looked into the history of this event the more disappointment he felt. No one had recorded this event to be true in history. On the other hand, the miracles Jesus performed had countless witnesses and had been acknowledged throughout history. His Christian friend told him about Jesus’ authority to perform these miracles. Malik learned Jesus not only healed people but he also forgave sins. He was eager to learn what more Jesus could do and as he learned about Jesus’ authority it became clear to him he needed to follow Jesus. He prayed for his salvation and became a follower of Jesus Christ. Pray for Malik as there are many others who are exposed to Christianity but need guidance to lead them in the right direction. Pray for him to grow in his faith and lead others who are in search of the truth. ', 'de-prayer-2023' ),
                __( '“I will cut off the chariot from Ephraim and the war horse from Jerusalem; and the battle bow shall be cut off, and he shall speak peace to the nations; his rule shall be from sea to sea, and from the River to the ends of the earth.” (Zechariah 9:10 ESV).

Lord God, would you break the weapons of spiritual and physical war that harm the church [in location] and would you speak peace to this and to every nation as you build your Kingdom to the ends of the earth. (Zechariah 9:10) May your peacemaking spirit take deep root in the church [in location] and would you grant them to shake the foundations of society with the power of their sacrifice, service, and forgiveness.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"Pray as though everything depended on God. Work as though everything depended on you." - Augustine', 'de-prayer-2023' ),
            ],
            [
                //day 8
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we have complete forgiveness of all our sins IN Christ! (Ephesians 4:32)', 'de-prayer-2023' ),
                __( 'Ahran, a new believer in Morocco shared: "I have always admired Christianity and its teachings, and I have always seen that those who believe and follow Christ are people, most of whom are good and of high morals. I watched a video on your Arabic website where a person tells his experience with Christ. I was impressed by what Christ did with him, which made me communicate with you to learn more. Christ is the Lord, and any wise person cannot ignore his life. When I accepted Christ in my life and prayed; I felt great comfort and peace.“  Praise God for Ahren and his new life in Christ.  Pray that he and others like him [in location] will grow in their new faith and find a strong fellowship of believers.', 'de-prayer-2023' ),
                __( '“Mark the blameless and behold the upright, for there is a future for the man of peace.” (Psalm 37:37 ESV).

Lord, would you raise up bold peacemakers within the church [in location] - men and women who believe wholeheartedly in your promise that there is a future for the man of peace. (Psalm 37:37) Jesus, ground the hopes of your followers [in location] in the future you have sovereignly prepared for them and guide their feet in the way of peace that leads to you and your glory.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'The Spirit of Christ is the Spirit of missions. The nearer we get to Him, the more intensely missionary we become. - Henry Martyn', 'de-prayer-2023' ),
            ],
            [
                //day 9
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that there is no condemnation at all IN Christ! (Romans 8:1)', 'de-prayer-2023' ),
                __( 'Mahmoud is a young man from Upper Egypt whose family lives in a small village. When he was eight years old, he was sent to Cairo to work to help the family. On his first vist to Cairo, he met his uncle, for whom he was going to work. His uncle put him to work all day and as the day ended, he thought he would go home with his uncle to his family. Instead, his uncle locked him in a dark room above his suit factory. Mahmoud was afraid and sat in a corner with his legs pulled up against his chest and arms wrapped tightly around them. He sat up crying all night, and all he could see was some light coming through holes in the roof that illuminated the rats crawling around the rafters. He would finally sleep as the sun came up, then his uncle would open the door and let him out to work another twelve hours.

When Mahmoud returned home, he was so traumatized he fell asleep on his mat on the floor of his family’s home. He slept for a week with his mom unable to wake him except for putting small amounts of food in his mouth. At the end of the week his father took him to the imam who told the family he had evil spirits in him. He charged the family a larger amount of money and wrote some Koranic verses on special paper, placed it in water to dissolve and had him drink it. This was the start of a life of traveling and working to help support his family till he finally moved full time to Cairo at age 14 to work. He found no hope for his life and he sought help from Islam, but he was told he just needed to pray 5 times a day.

Hope came one day when someone shared the Good News with Mahmoud in the café that he was working in. A relationship was formed and at one point a New Testament was given to him. Conversations of Jesus took place often and he told his father about it. On a visit to see his family, the father took the New Testament and began reading it. Mahmoud continued working to help his sisters be able to get married and his younger brother to go to university. His uncles abused him so much he decided to move to another country to find a job and he has been blessed greatly in this move. Conversations continue, hope grows, he is now reading the bible and he is moving to where he can overcome the bondage of Islam and embrace the freedom that comes with Jesus. Pray for Mahmoud to reach the point in his life where he gives his life over to Jesus.

Pray for the masses, who are held in the grip of cultural traditions and the bondage of Islam, to find the hope and the freedom in Jesus Christ.', 'de-prayer-2023' ),
                __( '“You have given me the shield of your salvation, and your right hand supported me, and your gentleness made me great.” (Psalm 18:35 ESV).

Lord, as your gentleness made David a great king after your own heart, may your gentleness shape, form, and inspire the church [in location] to walk in countercultural servanthood that your kingdom alone counts as great. (Psalm 18:35) Teach your followers [in location] the true meaning of greatness.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'This generation of Christians is responsible for this generation of souls on the earth! — Keith Green', 'de-prayer-2023' ),
            ],
            [
                //day 10
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we are new creations IN Christ! (2 Corinthians 5:17)', 'de-prayer-2023' ),
                __( 'Mesbah from Bangladesh said that, "Atheism seemed right after one becomes disillusioned with his religion”. But later he realized that this vast and orderly universe and every unique aspect was not created by chance. These masterful creations must be the creation of a Creator. He later attended a church service. The pastor presented an excellent argument for the existence of the Creator. After that, Mesbeh joined a Bible study and was baptized into Christ a few days later. Pray that as "the heavens declare the glory of God, and the sky above proclaims his handiwork..." (Psalm 19:1-4), men and women [in location] hear and turn to the One who spoke them into existence and continues to speak through the Word who became flesh.', 'de-prayer-2023' ),
                __( '“If others share this rightful claim on you, do not we even more? Nevertheless, we have not made use of this right, but we endure anything rather than put an obstacle in the way of the gospel of Christ.” (1 Corinthians 9:12 ESV).

Jesus, give the church [in location] grace to cherish your name above all else, that they would be equipped to endure in hope any measure of suffering or challenge, rather than see an obstacle placed in the way of your gospel. (1 Corinthians 9:12) The challenges and obstacles to the advance of the gospel [in location] are many, but as the church lays down it\'s rights and claims, you are faithful to bear the fruit of glory from the tree of suffering. May it be so [in location].', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'We can reach our world, if we will. The greatest lack today is not people or funds. The greatest need is prayer. — Wesley Duewel, head of OMS International', 'de-prayer-2023' ),
            ],
            [
                //day 11
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we have eternal life IN Christ! (Romans 6:23)', 'de-prayer-2023' ),
                __( 'When I was 29 years old I became addicted to drugs after my fiance broke up with me and my job was terrible.

Life was so bad I purchased as many drugs as I could in order to commit suicide. As I lay there waiting to die I prayed, “Are you Allah or are you God? Whoever you are, save me. I didn\'t think that life could be this hard. People are cruel and insensitive. I am addicted to alcohol and drugs. I know these are bad, but I use them to escape. Please help me if you can hear me, help me. If I deserve hell for killing myself, stop me right now. I want to be happy without being dependent on anything. I have lived far from you and offended you, show me where I made a mistake and teach me how to make a fresh start. I\'m about to die God, help me!"

Then I fell asleep. I heard a voice in my dream saying, “Ask and it will be given to you; seek and you will find; knock and the door will be opened to you. For everyone who asks receives; the one who seeks finds; and to the one who knocks, the door will be opened."

I had no idea what this meant, but sometime later I met a Christian who took out a Bible and showed me the same words I heard in my dream. They were from Matthew 7. As I read, I found peace and Jesus gave me hope. I realized that Jesus is Lord and savior. In a very short time, Jesus gave me healing, hope, and blessings. I got rid of all my addictions and bad habits without any medical support. Jesus saved me, and thanks to the Bible, I now know God very well and know that he is a loving father. I used to not like people, now I love them very much. We are no longer under the control of sin. I have become a new person and I am full of hope.', 'de-prayer-2023' ),
                __( '“Come and hear, all you who fear God, and I will tell what he has done for my soul.” (Psalm 66:16 ESV).

Lord God, you have faithfully written the testimony of your passionate love for the people [of location] across history and lives. May you raise up a generation of followers [in location] who cry with the Psalmist, "come and hear and I will tell you what God has done for my soul!" (Psalm 66:16) May they exhort one another to testify and may your Spirit carry faithfully that testimony to ears you\'ve prepared to hear and receive it.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“The history of missions is the history of answered prayer.” - Samuel Zwemer', 'de-prayer-2023' ),
            ],
            [
                //day 12
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that you supply all our needs IN Christ! (Philippians 4:19)', 'de-prayer-2023' ),
                __( 'Jane from Senegal found herself pregnant as a teenager and so somehow gave her self an abortion. A few years later, she was pregnant again. This time she decided to keep the baby, but in order to avoid shaming the family, her parents forced her to abort. She was 5 months along, and the baby was born alive. Her mother showed her the baby, and then buried it alive. And Jane lived in the grief and anger and bitterness that followed this event.

On Thursday night she walked through forgiveness with the team teaching soul care. It was HARD. There were tears, but Jesus brought beautiful freedom to her life.

Pray for spiritual seekers [in location] and all over the Muslim world to find freedom in Jesus as they follow His example in receiving forgiveness for their sins and extending forgiveness to those who have wronged them.', 'de-prayer-2023' ),
                __( '“Then my enemies will turn back in the day when I call. This I know, that God is for me.” (Psalm 56:9 ESV).

Father God, would you plant the seed of holy confidence in the hearts of your followers [in location]. May they grow in the humble, eternal assurance of your completed work of grace so that even in the darkest nights of persecution, loneliness, and temptation they might join the saints across generations in saying "This I know, that God is for me." (Psalm 56:9).
', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'In our lifetime, wouldn\'t it be sad if we spent more time washing dishes or swatting flies or mowing the yard or watching television than praying for world missions? — Dave Davidson', 'de-prayer-2023' ),
            ],
            [
                //day 13
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we have every spiritual blessing of Heaven IN Christ! (Ephesians 1:3)', 'de-prayer-2023' ),
                __( 'Zarish is a new believer in Pakistan who was miraculously healed from a spinal injury through the power of prayer. She reported feeling the presence of evil spirits in her house and is praying to Jesus that they will go away from her life. A lot of Muslims turn towards shrines and objects with black magic when they experience hardships. These things don’t really help them, instead they end up welcoming evil things in their homes and lives. People do these things because they are desperate and they easily follow others when they are offered a quick solution. Please pray for Zarish as she has found her new identity in Jesus. Pray she would only ask for help from Jesus and that any bad spirits will leave her alone.
                
                Pray for our Christian brothers and sisters [in location] and across the Muslim world to boldly show to neighbors and friends their refusal to put hope in anything other than Jesus. 
', 'de-prayer-2023' ),
                __( '“and was declared to be the Son of God in power according to the Spirit of holiness by his resurrection from the dead, Jesus Christ our Lord, through whom we have received grace and apostleship to bring about the obedience of faith for the sake of his name among all the nations,” (Romans 1:4-5 ESV).
                
Holy Spirit, cultivate and grow in the church [in location] the gifts of grace and apostleship that through this beautiful, unique expression of your body we might see the obedience of faith for the sake of your great name among all the nations of the earth. (Romans 1:4-5) Mold hearts and minds of obedient faith in your followers [in location] that they might teach and disciple their communities into love for Jesus."', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'A church that is not a missionary church is contradicting itself and quenching the Spirit. – Lausanne Covenant', 'de-prayer-2023' ),
            ],
            [
                //day 14
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we will be presented to you perfect IN Christ! (Colossians 1:28)', 'de-prayer-2023' ),
                __( 'I was never very religious, and I was a Muslim simply because my parents were. I believed that God was distant and angry with me. I suffer from a rare allergy condition. I feared for my life and in order to overcome my fear I tried to pray but felt nothing. Then I tried to memorize the Koran but as I read it, I found many contradictions and the words disturbed me. I felt that God wanted me to ask one of my friends about the Messiah. I didn’t know that she was a Christian, but she prayed with me and quoted Romans 5:8, “But God demonstrates his own love for us in this: While we were still sinners, Christ died for us.” I loved those words, and I began searching for testimonies on the internet. I researched until finally I felt that I was wasting my time by prolonging my decision. I knew the truth, and I surrendered my life to Jesus Christ. Pray that many throughout the Muslim world will know of God’s love and begin to love like Paul wrote about in 1 Corinthians 13.', 'de-prayer-2023' ),
                __( '“Then Paul answered, “What are you doing, weeping and breaking my heart? For I am ready not only to be imprisoned but even to die in Jerusalem for the name of the Lord Jesus.”” (Acts 21:13 ESV).

Lord Jesus, raise up a generation of followers [in location] so burdened for your glory among the nations and so convinced of your eternal worth that they might say with passion and hope "I am ready not only to be imprisoned, but even to die...for the name of the Lord Jesus." (Acts 21:13).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'If the Great Commission is true, our plans are not too big; they are too small. — Pat Morley', 'de-prayer-2023' ),
            ],
            [
                //day 15
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we cannot be separated from your love IN Christ! (Romans 8:32)', 'de-prayer-2023' ),
                __( 'Suneel is a very active MBB (Muslim background believer). He loves to share the Good News with his friends. One of his friends accepted Jesus recently. He is inspired by Suneel and wants to get baptized to proclaim his faith.
                
Please pray for Suneel and his efforts to share his faith with others. Pray for this new brother to continue to grow in his faith and be a witness to others just like Suneel.', 'de-prayer-2023' ),
                __( '“It is enough for the disciple to be like his teacher, and the servant like his master. If they have called the master of the house Beelzebul, how much more will they malign those of his household.” (Matthew 10:25 ESV).

Holy Spirit, would you breathe a spirit of spiritual satisfaction over your followers [in location], that they might resist the temptations and condemnations of the world and, instead, joyfully rest knowing that it is enough for a disciple to be like his teacher and a servant like his master. (Matthew 10:25). Give your church [in location] a profound satisfaction in becoming more and more like you, even as the world scoffs and condemns.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"We should not ask, \'What is wrong with the world?\', for that diagnosis has already been given. Rather we should ask, \'What has happened to the salt and light?\'"John Stott', 'de-prayer-2023' ),
            ],
            [
                //day 16
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that we are one body IN Christ! (Romans 12:5)', 'de-prayer-2023' ),
                __( 'Ruhi is ready to take the next step and be baptized.

\'I was a Sunni Muslim by birth, but now I belong to Jesus Christ and have become a better person. I changed when I discovered Jesus, and I became closer to Him. All thanks to Him, I\'m living in a continuous state of peace and joy. I wish I could serve Him and spread His word. I\'m studying the Bible now and ready for baptism. Kindly pray for me.\'

Pray for many like Ruhi [in location] that are new to faith and considering being wed to the Lamb of God through baptism.', 'de-prayer-2023' ),
                __( 'For we are slaves. Yet our God has not forsaken us in our slavery, but has extended to us his steadfast love before the kings of Persia, to grant us some reviving to set up the house of our God, to repair its ruins, and to give us protection in Judea and Jerusalem.” (Ezra 9:9 ESV).

Lord Jesus, would you affirm in your followers [in location] their identities as slaves - slaves to you, their good Master - no matter how countercultural and provocative this identity may be. May they say with the people of God, "we are slaves, but our God has not forsaken us in our slavery." (Ezra 9:9).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'It is possible for the most obscure person in a church, with a heart right toward God, to exercise as much power for the evangelization of the world, as it is for those who stand in the most prominent positions. — John R. Mott', 'de-prayer-2023' ),
            ],
            [
                //day 17
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus brought the message of the Kingdom of Heaven being at hand! (Matthew 4:17)', 'de-prayer-2023' ),
                __( 'Shahid became a believer two and a half years ago. He lives in Multan and comes from a family of “Pir Culture”. His father is a Pir and they have his grandfather’s shrine in their house where local people come with their prayer needs. A believer had been discipling him for over two years and arranged for him to meet with a local pastor and get baptized. This is a big step for him because baptism can be a big challenge when your whole family has strong opposing views. He was recently married to a Muslim woman arranged by his family and he shared this with her but she is still a Muslim by faith. He has joined a local church and is actively growing in faith.
                
Please pray for Shahid for any future challenges he will face as a growing believer and pray for his wife to also come to know Jesus and not be opposed to Him.', 'de-prayer-2023' ),
                __( '“O our God, will you not execute judgment on them? For we are powerless against this great horde that is coming against us. We do not know what to do, but our eyes are on you.”” (2 Chronicles 20:12 ESV).

Father God, you see the hopelessness and the brokenness that surrounds and threatens your church [in location]. You see how the enemy steals and destroys. And we ask that in the midst of the incomprehensible and insurmountable brokenness, you would revive and strengthen your followers [in location] that they might say with your Word, "we do not know what to do, but our eyes on you, Lord." (2 Chronicles 20:12).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'If you take missions out of the Bible, you won\'t have anything left but the covers. — Nina Gunter', 'de-prayer-2023' ),
            ],
            [
                //day 18
                __( 'God, we love you! As your Church, help us to do what it takes to let the people [of location] grasp the Good News that Jesus has authority even over all of nature! (Matthew 8:27)', 'de-prayer-2023' ),
                __( 'Hamid is a Muslim background believer who is facing a lot of difficulties and persecution because of his faith. He was reported and arrested by the police and is going through a court case because he decided to follow Jesus. He has been beaten by the police to threaten him and the law may not help him. This is a fear most of the Muslim people have when they decide to turn away from Islam.
                
Please pray for Hamid as he goes through this difficult time. He has more enemies than friends and his family may also not step up to help him. Pray for his protection, strength and comfort from God.', 'de-prayer-2023' ),
                __( '“Do not fear what you are about to suffer. Behold, the devil is about to throw some of you into prison, that you may be tested, and for ten days you will have tribulation. Be faithful unto death, and I will give you the crown of life.” (Revelation 2:10 ESV).

Lord Jesus, you have gone before us on the Way, showing what it means to be faithful unto death. Would you give your church [in location] the grace to remain faithful in proclamation and holiness unto death, that they might joyfully receive the crown of life that your perfect grace has prepared for them. (Revelation 2:10).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“His authority on earth allows us to dare to go to all the nations. His authority in heaven gives us our only hope of success. And His presence with us leaves us no other choice.” -John Stott', 'de-prayer-2023' ),
            ],
            [
                //day 19
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus was so overwhelmingly superior to demons that they literally begged Him for mercy! (Matthew 8:31)', 'de-prayer-2023' ),
                __( 'Sayed yearned to meet the Jesus he heard about from a Christian friend. His life was crazy with university, family business responsibilities and being there for all his friends. He was always stressed and overwhelmed with life. He had just broken up with the girl he thought was the one he would wed. Islam was a family tradition more than a faith to him, but he could not think of something as personal as knowing Jesus. That night, his Christian friend prayed and asked for Jesus to reveal Himself to Sayed.

Two nights after that prayer, Sayed fell asleep, and he started to dream. In his dream, he found himself on the street in front of his apartment. He saw his girlfriend down the street, and she turned and smiled at him. He waved to her, and she turned and walked away. He was so upset he sat right in the middle of the road and started to cry. He felt a hand on his shoulder and turned, immediately he knew it was Jesus who was sitting with him. He felt a total peace as Jesus spoke to him and told him that he loved him. Sayed looked at Jesus and told him he had beautiful hair. Jesus gave him a comb and he started to comb his own hair and it grew and looked like the hair Jesus had. Sayed said to Jesus, “You look like me.” Jesus smiled and said, “No, you look like me because you were created in my image.” He woke from the dream and knew the prayer from the other night had been answered.

Pray for dreams and visions across the Muslim world, but also pray for those who will go into the world and ask the question, “Have you ever had a dream or vision of a man in white?” Many have had this dream, but they have no one to help them understand what this dream can mean.', 'de-prayer-2023' ),
                __( '“And we have seen and testify that the Father has sent his Son to be the Savior of the world.” (1 John 4:14 ESV).

Lord God, grant your church [in location] the eyes to see and lips to testify to the miracle of the provision of your Son Jesus to be the savior of the world. (1 John 4:14) Your one and only Son, dispatched from his rightful throne in Heaven to live and die for the salvation of the nations. May your followers [in location] be known for their loyalty and devotion to this beautiful message.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '"I\'ve heard people say, \'I want more of a heart for missions.\' I always respond, \'Jesus tells you exactly how to get it. Put your money in missions - and in your church and the poor - and your heart will follow.\'" - Randy Alcorn', 'de-prayer-2023' ),
            ],
            [
                //day 20
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus\' message was that He wanted us to follow Him, the greatest man in the history of the universe! (Matthew 9:9)', 'de-prayer-2023' ),
                __( 'After reading the gospel of Matthew, Taariq, a new believer, said, \'I feel as if I am in another world. I feel at peace. Inner peace, as if I have left this world entirely for another. I thank you for all the information you have given me. I have read the book of Matthew, and its words entered my heart directly. It is wonderful.\'

We know God is doing incredible work in the lives of Arabs across the Middle East and North Africa.

Pray for new believers like Taariq to fall in love with Scripture and to consume it daily.', 'de-prayer-2023' ),
                __( '“With God we shall do valiantly; it is he who will tread down our foes.” (Psalm 108:13 ESV).

Father God, as your followers [in location] look out upon the resources of the enemy arrayed against them, may you grant them fearlessness and confidence in your matchless power. May their hearts learn to answer the attacks of the enemy, saying "with God we shall do valiantly, it is he who will tread down our foes." (Psalm 108:13).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“What can we do to win these men to Christ?” – Richard Wurmbrand, The Voice of the Martyrs (referring to the men who were persecuting him)', 'de-prayer-2023' ),
            ],
            [
                //day 21
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus offered us life! (Matthew 10:38)', 'de-prayer-2023' ),
                __( 'Hamzaa, a taxi driver living in Iraq, first heard about Christianity when tuning in to a Christian radio station while he was working. He became curious and wanted to learn more, so he began searching the internet. He found our Arabic ministry website and sent us the following message. \'I am a Muslim, and I am convinced that Christianity is the true way. I want to become a Christian, but I don’t know how.\'

Mira*, a member of our Arabic response team, picked up his message and replied. She explained the Gospel to him, and after a short while, she led him in prayer, and Hamzaa became a Christian. God had been preparing Hamzaa\'s heart for some time, and once he found our website, he was ready to commit his life to the Lord.

Soon after, we introduced Hamzaa to local believers in Iraq, and he began meeting with them face to face. We received this encouraging message from the local believers; \'Hamzaa is very hungry to learn and actively engages with us. We are now meeting twice a week and becoming friends as a group. We are going to begin doing activities together to develop that friendship and to grow in the Lord together.\'

God is doing amazing miraculous works across the Arab world.

Pray that Hamzaa will continue to grow in his faith. Pray for strong friendships to develop and that he will continue to meet with fellow believers.', 'de-prayer-2023' ),
                __( '“By Silvanus, a faithful brother as I regard him, I have written briefly to you, exhorting and declaring that this is the true grace of God. Stand firm in it.” (1 Peter 5:12 ESV).

Heavenly Father, teach your followers [in location] to cling to the true grace of God and to stand firm in it. (1 Peter 5:12) As fear and doubt swirl around these precious friends, would you be the solid Rock on which they can stand and build this eternally valuable corner of your kingdom.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“We who have Christ’s eternal life need to throw away our own lives.” -George Verwer', 'de-prayer-2023' ),
            ],
            [
                //day 22
                __( 'God, we love you! As your Church help us do what it takes to let the people [of location] grasp the Good News that Jesus responded with compassion to persistent faith! (Matthew 15:28)', 'de-prayer-2023' ),
                __( 'Tauqeer is a seeker who has been talking to a believer online about whether Mohammad is the greatest prophet or not? The believer asked him, "Should we follow someone who is dead or someone who is alive?" This confused Tauqeer and made him question his beliefs. He is questioning if Jesus was more than a prophet. Most Muslims believe Jesus is just a prophet who came to teach people good things and performed a lot of miracles.
                
Pray Taqueer will come to know Jesus did more than perform miracles and will open his heart to the Truth.', 'de-prayer-2023' ),
                __( '“he says: “It is too light a thing that you should be my servant to raise up the tribes of Jacob and to bring back the preserved of Israel; I will make you as a light for the nations, that my salvation may reach to the end of the earth.”” (Isaiah 49:6 ESV).

Holy Spirit, come and do the work that only you can do in the church [in location]. Ignite them with passion for the glory and the name of Jesus that burns so brightly that it cannot help but be witnessed and shared in every corner [of location] and to the ends of the earth. (Isaiah 49:6).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( 'The question is not whether we will die, but whether we will die in a way that bears much fruit. - Adoniram Judson', 'de-prayer-2023' ),
            ],
            [
                //day 23
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus had authority over all disease and disability! (Matthew 15:31)', 'de-prayer-2023' ),
                __( 'Farah fled war-torn Syria with her husband and small children when the war broke out. They found refuge in a nearby country and established a new life together as a family. Although life was difficult as a refugee in a new country, Farah discovered an openness she had not experienced in Syria. For the first time, she could explore questions about faith and religion. In April 2021, Farah messaged us through our Arabic ministry website. She wanted to read the Bible but was unsure where to begin. Habib*, one of our online Arabic responders, talked with Farah for several weeks. They chatted online about many aspects of the Christian faith. Farah brought her questions about the Bible to Habib, and they studied God\'s word together. After a short time, Farah was convinced. She accepted Jesus Christ as her savior and gave her heart to the Lord.

Life did not get easier for Farah and her family. She faced persecution, rejection and discrimination because of her new faith. She tried to share the story of Jesus with her husband and children, but they didn\'t want to hear about it. Undeterred, she began attending a local church and was baptized. Farah continued studying the Bible, and her love for Jesus grew.

She began meeting regularly with a group of Syrian women, and eventually, she felt comfortable sharing her faith. They also wanted to know the peace Farah felt, so each woman gave her life to Christ one by one. They now meet in Farah\'s home and study the Bible together!

Farah remains firm in her faith despite challenging circumstances, sickness, pain, persecution and rejection. She is faithful and continues to pray for her husband and children. Her love for Jesus has brought this precious group of Syrian women to know and love the Lord. Praise God for Farah and her brave desire to share her faith and be a witness to those around her.

Now, because of Farah\'s* steadfast faith and determination, many others are following Jesus.
', 'de-prayer-2023' ),
                __( '“And they have conquered him by the blood of the Lamb and by the word of their testimony, for they loved not their lives even unto death.” (Revelation 12:11 ESV).

Lord Jesus, by your blood your followers [in location] have become conquerors of sin and death and even more than conquerors. May your church [in location] cling to the eternal hope and promises that you have won and may a heavenly host one day sing over them "they loved not their lives even unto death." (Revelation 12:11).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“It’s not that God has a mission for His Church in the world, but that God has a Church for His mission in the world.” – Chris Wright', 'de-prayer-2023' ),
            ],
            [
                //day 24
                __( 'God, we love you! As your Church help us do what it takes to let the people [of location] grasp the Good News that Jesus offered a path to greatness in the Kingdom that anyone could choose to follow! (Matthew 18:4)', 'de-prayer-2023' ),
                __( 'I am a forty-six years old woman from Tunisia. I saw a vision. The Messiah said, “I am the Truth.” I had already given up on Islam because of the violence. I never really felt God’s presence in my life before, but when I saw the Messiah, everything changed. I felt God’s peace. I started reading the Bible with some Christians.
                
Pray that our group of seekers will remain committed to knowing God through His Word and obeying His commands.', 'de-prayer-2023' ),
                __( '“In days to come Jacob shall take root, Israel shall blossom and put forth shoots and fill the whole world with fruit.” (Isaiah 27:6 ESV).

Lord Jesus, would the hope of your glory and the joy of your salvation take root deeply in your church [in location]. And by your grace and power, would you cause spiritual fruit to blossom in this desert place, beginning a joyful harvest of souls across the nations and the ends of earth, as you have promised. (Isaiah 27:6).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“Rediscover the real meaning of the Great Commission. Beginning in our own prayer and devotional lives, we must begin to feel the compassion of the Lord for a lost and dying world. As we have already seen, the Great Commission is not something that was given to a tiny group of specially trained and educated envoys. It was given to all Christians—to the whole Church. It is something that we are all to be engaged in naturally every day.” – K.P. Yohannan, Come, Let’s Reach the World', 'de-prayer-2023' ),
            ],
            [
                //day 25
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus knowingly took one step after another toward Jerusalem knowing He would be condemned to death, mocked, flogged, crucified and then be raised on the third day! (Matthew 20:19)', 'de-prayer-2023' ),
                __( 'Hamza is a 27 years old man who lives in Punjab. He has always lived his life following Islamic rules closely but never felt satisfied as a follower. He spent a lot of time looking at videos on YouTube and Facebook so he could learn to do better but the more he looked the more he felt restless. One day he was looking at Facebook and came across content about Jesus’ sacrifice. He had never had an encounter with a Christian before and didn’t know much about Christian faith. He decided to send a message and connected with a believer. He told the believer that he tries to follow all the rules in Islam but he always feels restless because he doesn’t have any hope he will go to heaven. The Quran doesn’t tell him anything about having assurance that if he keeps all the rules he will go to heaven. He asked many questions about sacrifice, sacrificing animals and why Christians don’t perform any sacrifices and came to the realization that Jesus is the only sacrifice he needed. Hamza talked to the believer for about a week and decided his only way to heaven is through Jesus. He put his faith in Jesus alone.', 'de-prayer-2023' ),
                __( '“So also you have sorrow now, but I will see you again, and your hearts will rejoice, and no one will take your joy from you.” (John 16:22 ESV).

Lord Jesus, write the promise of your return and the power of your spirit upon the hearts of your followers [in location] that they would be filled with the joy of salvation and expectation that no one can take away from them. (John 16:22) Even in the darkness of persecution and doubt and fear, may their joy be unshakable.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“Jesus promised his disciples three things: they would be completely fearless, absurdly happy, and in constant trouble.” – G.K. Chesterton', 'de-prayer-2023' ),
            ],
            [
                //day 26
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus taught that for God those who have died are alive! (Matthew 22:32)', 'de-prayer-2023' ),
                __( 'Since I was child, I respected Islam, prayed, read the Koran and the Hadith, and watched Islamic TV programs. As I prayed, I would cry out and ask God to draw me closer to him. As I grew, I began to have problems with my family. When I shared my opinion, it seemed like they just wanted to argue with me. Finally, I left home to go and live with my sister. One night, as I cried myself to sleep, I had a vision of a man. I could not see his face because it was light. I could not stand and fell to the ground. In the dream, I was young and small and was wearing a crown. He put his hand on me and said, “You are mine. Don’t fear.” I tried to find an explanation for this dream. Someone told me I had seen the Messiah. I didn’t know anything about Christianity but began to search. One day I posted on Facebook,“My only hope is that God will accept me.” A Christian wrote me and told me about God’s love for me and sent me verses from the Bible. Inwardly I struggled between what I had always believed and the new truth I was learning. I finally decided to follow Jesus. I shared with my family and my brother, sister, and niece also accepted Jesus.
                
Pray that we will start a church in our home and that we will boldly tell others of God’s love.', 'de-prayer-2023' ),
                __( '“and that repentance for the forgiveness of sins should be proclaimed in his name to all nations, beginning from Jerusalem.” (Luke 24:47 ESV).

Lord Jesus, impart your passion for your own glory among the nations to your followers [in location] that they would be filled with wonder and expectation at the seeming impossibility of seeing repentance for the forgiveness of sins proclaimed in your name to all nations. (Luke 24:47) Give your followers [in location] a burning passion for the great commission and your global mission, even as they grow in boldness within their own borders.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“Put legs to your prayers” – Ray Comfort', 'de-prayer-2023' ),
            ],
            [
                //day 27
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus invited us to make you the center of our love and affection! (Matthew 22:37-40)', 'de-prayer-2023' ),
                __( 'I am a married woman with two daughters. My daughters decided to follow Jesus, and I fought with them about their decision for a long time. Over time, I developed a liver disease. The doctor wanted to start treatment. My daughters told me they would pray for me in the name of Jesus Christ. They said, “He will heal you but more than that he will save you from your sins.” I thought, “No problem. Let them try, and we will see what happens.” At that time when they were praying, I was resting in my room alone and the weather was very hot. I felt a gentle breeze blow over me. I heard a voice say my name three times. Each time the voice was stronger. I got up and got dressed. I went to my daughters and asked, “Did you call me?” They said, “no.” They continued praying for me. Then I went back to my room and realized that I had heard the voice of the Messiah, and He touched me by healing me. The next day I went to the doctor. He said, “Please forgive us. We were wrong. You are not sick.” I surrendered my life to the Lord and began my journey walking with Him.
                
Pray for those who are sick and without hope. That Jesus will appear to them and heal them so that they may know that He is true and is their Savior.', 'de-prayer-2023' ),
                __( '“Though he slay me, I will hope in him; yet I will argue my ways to his face.” (Job 13:15 ESV).

Father God, grant your followers [in location] a profound trust in your goodness and your sovereign power, that they might proclaim with Job "though he slay me, I will hope in him." (Job 13:15) Teach the church [in location] to stand in awe and humble reverence toward your perfect plans and purposes, even as the waves of tragedy and challenge wash over them.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“I believe that in each generation God has called enough men and women to evangelize all the yet unreached tribes of the earth. It is not God who does not call. It is man who will not respond!” – Isobel Kuhn, 1901-1957, missionary to China and Thailand', 'de-prayer-2023' ),
            ],
            [
                //day 28
                __( 'God, we love you! As your Church help us do what it takes to let the people [of location] grasp the Good News that Jesus is coming back like lightning! (Matthew 24:27)', 'de-prayer-2023' ),
                __( 'I am a twenty-three year old woman. My family situation is very difficult, especially with my father. I finally ran away. I went through some very hard circumstances. One day a friend introduced me to a Christian family. They welcomed me and told me about the Messiah. They said, “The Messiah is able to help you in your suffering.” Later I got online and was looking for a solution to my problems. Again, I was shocked to find information about the Messiah. I met Christians and they prayed with me a lot. One day I woke up and I had such joy in my heart. I heard a voice say, “Accept the Messiah. Accept the Messiah.” I accepted Christ and was filled with the Holy Spirit. I felt new life come into my body and fill me with strength and renew my soul. Within a week, God began to prompt me to forgive my father. Pray that God will give me faith to trust Him and forgive my father. Pray for others who are bound by the slavery of bitterness and unforgiveness.
                
Pray that God will give them strength to forgive.', 'de-prayer-2023' ),
                __( '“Go your way; behold, I am sending you out as lambs in the midst of wolves.” (Luke 10:3 ESV).

Lord Jesus, you have sent your followers [in location] out as lambs in the midst of wolves. Be their ever-mindful, every-caring shepherd as you grow them in confidence and steadfastness to trust you as the wolves encircle and threaten. Would you give them a supernatural, attractive gentleness that even their suffering might a witness to their enemies who would see them divided and lost. (Luke 10:3).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“If you are ever inclined to pray for a missionary, do it at once, where ever you are. Perhaps he may be in great peril at that moment.” – Amy Carmichael, 1867-1951, missionary to India', 'de-prayer-2023' ),
            ],
            [
                //day 29
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus will bless those who are faithful in this life! (Matthew 24:47)', 'de-prayer-2023' ),
                __( 'I am Nasser, and I am from Afghanistan. When I was a teenager, my family fled The Taliban and went to Pakistan. I was from a well-to-do family, and my parents had money to send my siblings and I to learn English at a learning center there that some westerners taught at. One of the teachers played the guitar really well, and I hadn\'t heard this instrument before - we have other kinds of instruments in Afghanistan. I asked him if he would come home with me to play the guitar at my house and have dinner with my family. Before beginning dinner, my father thought to honor our guest and his culture by asking him to thank Allah for the food. As the westerner prayed, it was the first time I felt peace in my entire tumultuous life -- I looked at this man as he prayed, and I could see this overwhelming peace and joy, and I wanted it. As he finished praying, I heard him say in Urdu, "in Jesus\' name, Amen." I knew then there must be some connection to Jesus and this guy\'s peace and joy. In the coming weeks, that man led me to Christ, and then I led my family to Christ. We moved back to Afghanistan a couple years later, and by the grace of God we saw many Afghans come to faith in Christ, some even who are still in Afghanistan and remain a light under the current regime.

Please pray for the persecuted church in Afghanistan:
- to love their enemies
- to be filled with love and boldness to share the gospel, heal the sick and cast out demons
- to multiply disciples, churches, and leaders among every people and place in that country', 'de-prayer-2023' ),
                __( '“in whom we have boldness and access with confidence through our faith in him.” (Ephesians 3:12 ESV).

Lord God, grant your followers [in location] the boldness and confidence reserved for Sons and Daughters of the King as you reassure them not only of their salvation, but their commissioning as witnesses and ministers in this broken world. (Ephesians 3:12) Remove by your gentle spirit any lie or obstacle that would threaten the confidence with which these precious ones enter the Holy of Holies.', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“Prayer is not a preparation for the battle; it is the battle!” – Leonard Ravenhill', 'de-prayer-2023' ),
            ],
            [
                //day 30
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus eagerly awaits the Kingdom to drink wine with us! (Matthew 26:29)', 'de-prayer-2023' ),
                __( 'I am a thirty-year-old man from Tunisia. I was raised in a strict, practicing Muslim family. The first time I went to a church building, I had a government job to watch the Christians. I was surprised by their simple message and wondered why we were afraid of them. One day the Christians gave me a Bible and explained it to me. They prayed for me. I went home and prayed, “God, you know me. If you are true, speak to me.” I had a dream. There were six people being crucified on a cross. The Messiah was also on a cross. My friend from the police gave me a gun and said to shoot them. The Messiah said, “I will never die,” and then he pointed to the others, “They will not die either.” I woke up and called my friend in the dream. He had had the same dream! I understand that only the Messiah offers eternal life and that is why Christians are not afraid. I gave my life to Christ.
                
Pray that Muslims this Ramadan will have dreams of Christ and will not be afraid to share the Good News!', 'de-prayer-2023' ),
                __( '“But though we had already suffered and been shamefully treated at Philippi, as you know, we had boldness in our God to declare to you the gospel of God in the midst of much conflict.” (1 Thessalonians 2:2 ESV).

Lord Jesus, you see the shameful treatment and suffering of many of your followers [in location]. And we pray that as your sovereign hand guides them through adversity, they would rise up in boldness in their God to continue to declare the gospel in the midst of much conflict. (1 Thessalonians 2:2) May there be no conflict or persecution that quiets the voices of your church [in location].', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“We never know how God will answer our prayers, but we can expect that He will get us involved in His plan for the answer. If we are true intercessors, we must be ready to take part in God’s work on behalf of the people for whom we pray.” – Corrie Ten Boom', 'de-prayer-2023' ),
            ],
            [
                //day 31
                __( 'God, we love you! As your Church, help us do what it takes to let the people [of location] grasp the Good News that Jesus will be seated at the right hand of Power and come on the clouds of Heaven! (Matthew 26:64)', 'de-prayer-2023' ),
                __( 'I am a twenty-two year old woman and study at the university. Before I was born, my mother dedicated me to an Islamic saint and made a covenant. Every year of my life I was made to go back to where the Islamic saint is buried, cut myself, and do a blood sacrifice. I feel that I have been in spiritual bondage and want to break free. I had a vision six times in which someone was holding my hand. The man said, “I love you. Follow me.” I wondered if He could be the Messiah. I searched in many places. Finally, I found someone on the internet who explained God’s love to me. Unfortunately, I have been living in much sin and all of my friends are like me. At first, I was in denial that my actions were actually sin, but the Lord convicted me and I spent one night in a prayer of repentance. I know of many others, like me, living in sin.
            
            Please pray that God will convict them of their sins, rescue them, and give them new life. Pray also that I will be completely free in Christ.', 'de-prayer-2023' ),
                __( '“And he put the wood in order and cut the bull in pieces and laid it on the wood. And he said, “Fill four jars with water and pour it on the burnt offering and on the wood.”” (1 Kings 18:33 ESV).

Lord God, give your church [in location] the boldness of Elijah who called for more water to soak the burnt offering before the eyes of the watching world. Grant that same spirit to your followers [in location] that they might boldly call upon your power and name to deliver and to witness to your majesty before the watchful eyes [of location] and all the nations of the earth. (1 Kings 18:33).', 'de-prayer-2023' ),
                __( 'As you look at this image, how does God lead you to pray for these people?', 'de-prayer-2023' ),
                __( '“The greatest missionary is the Bible in the mother tongue. It needs no furlough and is never considered a foreigner.” – William Cameron Townsend,1896-1982, Missionary to Peru and Mexico', 'de-prayer-2023' ),
            ],
        ];


        function ramadan_format_message( $message, $fields ) {
            $message = make_clickable( $message );
            $message = str_replace( '[in location]', !empty( $fields['in_location'] ) ? $fields['in_location'] : '[in location]', $message );
            $message = str_replace( '[of location]', !empty( $fields['of_location'] ) ? $fields['of_location'] : '[of location]', $message );
            $message = str_replace( '[people_group]', !empty( $fields['ppl_group'] ) ? $fields['ppl_group'] : '[people_group]', $message );
            return nl2br( $message );
        }

        $content = [];
        foreach ( $data as $index => $d ){

            $number = $index +1;
            if ( $number < 10 ){
                $number = '0' . $number;
            }

            $image = '';
            if ( file_exists( Ramadan_2023::$plugin_dir . 'images/' . $number . '.jpg' ) ) {
                $image = '<figure class="wp-block-image p4m_prayer_image"><img src="' . plugins_url( 'images/' . $number . '.jpg', __DIR__ ) . '" alt="' . $number . '"  /></figure >';
            }

            $content[] = [
                'excerpt' => wp_kses_post( ramadan_format_message( $d[0], $fields ) ),
                'content' => [
                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'Our Treasure in Jesus', 'de-prayer-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[0], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'Testimonies from Around the World', 'de-prayer-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[1], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'Biblical Prayers', 'de-prayer-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[2], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'Prayer Walk', 'de-prayer-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[3], $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',

                    '<!-- wp:image -->',
                    $image,
                    '<!-- /wp:image -->',

                    '<!-- wp:heading {"level":3} -->',
                    '<h3><strong>' . __( 'Inspirational Quotes', 'de-prayer-2023' ) . '</strong></h3>',
                    '<!-- /wp:heading -->',

                    '<!-- wp:paragraph -->',
                    '<p>' . wp_kses_post( ramadan_format_message( $d[4], $fields ) ) . '</p>',
                    '<p>' . esc_html( ramadan_format_message( __( 'How could this quote inspire you to pray for [people_group]? For yourself?', 'de-prayer-2023' ), $fields ) ) . '</p>',
                    '<!-- /wp:paragraph -->',
                ]
            ];
        }
        return $content;
    }
}