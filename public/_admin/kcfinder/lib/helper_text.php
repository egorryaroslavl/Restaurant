<?php

    /** This file is part of KCFinder project
     *
     * @desc      Text processing helper class
     * @package   KCFinder
     * @version   2.51
     * @author    Pavel Tzonkov <pavelc@users.sourceforge.net>
     * @copyright 2010, 2011 KCFinder Project
     * @license   http://www.opensource.org/licenses/gpl-2.0.php GPLv2
     * @license   http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
     * @link      http://kcfinder.sunhater.com
     */
    class text
    {

        /** Replace repeated white spaces to single space
         *
         * @param string $string
         *
         * @return string
         */

        static function clearWhitespaces( $string )
        {
            return trim( preg_replace( '/\s+/s', " ", $string ) );
        }

        /** Normalize the string for HTML attribute value
         *
         * @param string $string
         *
         * @return string
         */

        static function htmlValue( $string )
        {
            return
                str_replace( '"', "&quot;",
                    str_replace( "'", '&#39;',
                        str_replace( '<', '&lt;',
                            str_replace( '&', "&amp;",
                                $string ) ) ) );
        }

        /** Normalize the string for JavaScript string value
         *
         * @param string $string
         *
         * @return string
         */

        static function jsValue( $string )
        {
            return
                preg_replace( '/\r?\n/', "\\n",
                    str_replace( '"', "\\\"",
                        str_replace( "'", "\\'",
                            str_replace( "\\", "\\\\",
                                $string ) ) ) );
        }

        /** Normalize the string for XML tag content data
         *
         * @param string $string
         * @param bool   $cdata
         */

        static function xmlData( $string, $cdata = false )
        {
            $string = str_replace( "]]>", "]]]]><![CDATA[>", $string );
            if( !$cdata )
                $string = "<![CDATA[$string]]>";
            return $string;
        }

        /** Returns compressed content of given CSS code
         *
         * @param string $code
         *
         * @return string
         */

        static function compressCSS( $code )
        {
            $code = self::clearWhitespaces( $code );
            $code = preg_replace( '/ ?\{ ?/', "{", $code );
            $code = preg_replace( '/ ?\} ?/', "}", $code );
            $code = preg_replace( '/ ?\; ?/', ";", $code );
            $code = preg_replace( '/ ?\> ?/', ">", $code );
            $code = preg_replace( '/ ?\, ?/', ",", $code );
            $code = preg_replace( '/ ?\: ?/', ":", $code );
            $code = str_replace( ";}", "}", $code );
            return $code;
        }


        static function translite( $string )
        {
            $dictionary = array( "А" => "a", "Б" => "b", "В" => "v", "Г" => "g",
                                 "Д" => "d", "Е" => "e", "Ж" => "zh", "З" => "z", "И" => "i",
                                 "Й" => "y", "К" => "K", "Л" => "l", "М" => "m", "Н" => "n",
                                 "О" => "o", "П" => "p", "Р" => "r", "С" => "s", "Т" => "t",
                                 "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch",
                                 "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "",
                                 "Э" => "e", "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b",
                                 "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "zh",
                                 "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
                                 "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
                                 "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
                                 "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
                                 "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
                                 "-" => "_", " " => "_", "," => "_", "." => "_", "?" => "", "!" => "", "«" => "",
                                 "»" => "", ":" => "", 'ё' => "e", 'Ё' => "e", "*" => ""


            );

            $string = mb_strtolower( strtr( strip_tags( $string ), $dictionary ) );
            return preg_replace( '/[_]+/', '_', $string );
        }

        static public function TextLimit( $string, $word_limit = 100 )
        {
            $words = split( ' ', $string );
            if( count( $words ) <= $word_limit ){
                return $string;
            }
            $text = join( ' ', array_slice( $words, 0, $word_limit ) ) . "...";

            return $text;

        }

        /**
         * Очищает текст от всего что не буква.
         * Удаляет слова короче $strlenLimit символов
         *
         * @param     $text
         * @param int $strlenLimit
         *
         * @return string
         */
        static public function clearText( $text, $strlenLimit = 2 )
        {

            mb_internal_encoding( "UTF-8" );

            mb_regex_encoding( "UTF-8" );

            $arr = array();

            $s = mb_eregi_replace( '[^а-яА-Яa-zA-Z]', ' ', mb_convert_case( $text, MB_CASE_LOWER, "UTF-8" ) );

            $tar = explode( ' ', $s );

            $tar = array_diff( $tar, array( '' ) );

            $tar = array_unique( $tar );

            foreach( $tar as $val ){
                if( mb_strlen( $val, 'utf8' ) > $strlenLimit ){
                    $arr[ ] = $val;
                }
            }

            $clearText = implode( ' ', $arr );

            return $clearText;
        }

        /**
         * Возвращает первые $limit слов текста
         * Если передан $addToEnd, добавляет его в конец текста
         *
         * @param      $text
         * @param int  $limit
         * @param bool $addToEnd
         *
         * @return string
         */
        static function SomeFirstWordsFromText( $text, $limit = 10, $addToEnd = false )
        {

            if( count( explode( " ", $text ) ) <= $limit + 1 ){
                return $text;
            }

            $ar = explode( " ", $text, $limit + 1 );

            array_pop( $ar );

            return implode( " ", $ar ) . $addToEnd;

        }
    }