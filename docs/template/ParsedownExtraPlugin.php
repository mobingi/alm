<?php

/**
 * Author: Taufik Nurrohman
 * URL: http://latitudu.com
 * Version: 1.1.1
 */

// <https://github.com/tovic/parsedown-extra-plugin>
class ParsedownExtraPlugin extends ParsedownExtra {

    // version
    const version = '1.1.1';

    // self-closing HTML tags
    public $element_suffix = ' />';

    // predefined abbreviations
    public $abbreviations = array();

    // predefined links URL and title
    public $links = array();

    // automatic link attributes
    public $links_attr = array();

    // automatic external link attributes
    public $links_external_attr = array();

    // automatic image attributes
    public $images_attr = array();

    // automatic external image attributes
    public $images_external_attr = array();

    // custom code class for class name without dot prefix
    public $code_class = 'language-%s';

    // custom code text
    public $code_text = null;

    // custom code block text
    public $code_block_text = null;

    // put `<code>` attributes on `<pre>` element?
    public $code_block_attr_on_parent = false;

    // custom table class or use `1` to add `border="1"` attribute
    public $table_class = null;

    // custom table alignment class
    public $table_align_class = null;

    // custom footnote ID format
    public $footnote_link_id = 'fn:%s';

    // custom footnote back ID format
    public $footnote_back_link_id = 'fnref%s:%s';

    // custom footnote class
    public $footnote_class = 'footnotes';

    // custom footnote link class
    public $footnote_link_class = 'footnote-ref';

    // custom footnote back link class
    public $footnote_back_link_class = 'footnote-backref';

    // custom footnote link text
    public $footnote_link_text = null;

    // custom footnote back link text
    public $footnote_back_link_text = '&#8617;';

    // ~
    function __construct() {
        if(parent::version < '0.7.0') {
            throw new Exception('ParsedownExtraPlugin requires a later version of ParsedownExtra');
        }
        parent::__construct();
    }

    // ~
    protected function element(array $element) {
        $markup = parent::element($element);
        if( ! isset($element['text'])) {
            return str_replace(' />', $this->element_suffix, $markup);
        }
        return $markup;
    }

    // Check for external links ...
    private function __doLink($excerpt, $fn) {
        if($data = call_user_func('parent::' . $fn, $excerpt)) {
            $url = $data['element']['attributes']['href'];
            if(isset($_SERVER['HTTP_HOST'])) {
                $host = $_SERVER['HTTP_HOST'];
            } else if(isset($_SERVER['SERVER_NAME'])) {
                $host = $_SERVER['SERVER_NAME'];
            } else {
                $host = "";
            }
            $in = $url === "" || $host === "" || strpos($url, 'https://' . $host) === 0 || strpos($url, 'http://' . $host) === 0 || strpos($url, '//' . $host) === 0 || strpos($url, '/') === 0 || strpos($url, '?') === 0 || strpos($url, '#') === 0 || strpos($url, 'javascript:') === 0 || strpos($url, '.') === 0 || strpos($url, '://') === false;
            if(strpos($url, '//') === 0 && strpos($url, '//' . $host) !== 0) $in = false;
            $attrs = $this->links_attr;
            if( ! $in) $attrs = array_merge($attrs, $this->links_external_attr);
            $data['element']['attributes'] = array_merge($attrs, $data['element']['attributes']);
        }
        return $data;
    }

    // ~
    protected function inlineLink($excerpt) {
        return $this->__doLink($excerpt, __FUNCTION__);
    }

    // ~
    protected function inlineUrl($excerpt) {
        return $this->__doLink($excerpt, __FUNCTION__);
    }

    // ~
    protected function inlineUrlTag($excerpt) {
        return $this->__doLink($excerpt, __FUNCTION__);
    }

    // ~
    protected function inlineImage($excerpt) {
        $links_attr = $this->links_attr;
        $links_external_attr = $this->links_external_attr;
        $this->links_attr = $this->images_attr;
        $this->links_external_attr = $this->images_external_attr;
        $data = parent::inlineImage($excerpt);
        $this->links_attr = $links_attr;
        $this->links_external_attr = $links_external_attr;
        unset($links_attr, $links_external_attr);
        return $data;
    }

    // `~~~ php` → `<pre><code class="language-php">`
    // `~~~ php html` → `<pre><code class="language-php language-html">`
    // `~~~ .php` → `<pre><code class="php">`
    // `~~~ .php.html` → `<pre><code class="php html">`
    // `~~~ .php html` → `<pre><code class="php language-html">`
    // `~~~ {.php #foo}` → `<pre><code id="foo" class="php">`
    protected function blockFencedCode($line) {
        if(preg_match('/^[' . $line['text'][0] . ']{3,}[ ]*((?:\.?[-\w]+[ ]*)+|\{' . $this->regexAttribute . '+\})?[ ]*$/', $line['text'], $m)) {
            $element = array(
                'name' => 'code',
                'text' => ""
            );
            $attrs = array();
            if(isset($m[1])) {
                if($m[1][0] === '{' && substr($m[1], -1) === '}') {
                    $attrs = $this->parseAttributeData(substr(substr($m[1], 1), 0, -1));
                } else {
                    if(is_callable($this->code_class)) {
                        $attrs['class'] = call_user_func($this->code_class, $m[1], $line, $m, $this);
                    } else {
                        $class = "";
                        foreach(explode(' ', $m[1]) as $k => $v) {
                            if( ! $v) continue;
                            if(strpos($v, '.') !== 0) {
                                $class .= ' ' . sprintf($this->code_class, $v);
                            } else {
                                $class .= str_replace('.', ' ', $v);
                            }
                        }
                        $attrs['class'] = substr($class, 1);
                    }
                }
            }
            $block = array(
                'char' => $line['text'][0],
                'element' => array(
                    'name' => 'pre',
                    'handler' => 'element',
                    'text' => $element
                )
            );
            if( ! $this->code_block_attr_on_parent) {
                $block['element']['text']['attributes'] = $attrs;
            } else {
                $block['element']['attributes'] = $attrs;
            }
            return $block;
        }
    }

    // ~
    protected function unmarkedText($text) {
        if( ! isset($this->DefinitionData['Abbreviation'])) {
            $this->DefinitionData['Abbreviation'] = $this->abbreviations;
        } else {
            $this->DefinitionData['Abbreviation'] = array_merge($this->abbreviations, $this->DefinitionData['Abbreviation']);
        }
        if( ! isset($this->DefinitionData['Reference'])) {
            $this->DefinitionData['Reference'] = $this->links;
        } else {
            $this->DefinitionData['Reference'] = array_merge($this->links, $this->DefinitionData['Reference']);
        }
        return str_replace('<br />', '<br' . $this->element_suffix, parent::unmarkedText($text));
    }

    // ~
    private function __doTable($line, $block, $fn, $i) {
        if($block = call_user_func('parent::' . $fn, $line, $block)) {
            $block['element']['attributes'][is_int($this->table_class) ? 'border' : 'class'] = $this->table_class;
            if( ! $this->table_align_class) return $block;
            if(isset($block['element']['text'][$i]['text'])) {
                foreach($block['element']['text'][$i]['text'] as $k => &$v) {
                    if(isset($v['text'])) {
                        foreach($v['text'] as $kk => &$vv) {
                            $align = isset($block['alignments'][$kk]) ? sprintf($this->table_align_class, $block['alignments'][$kk]) : null;
                            $vv['attributes'] = array('class' => $align);
                        }
                    }
                }
            }
        }
        return $block;
    }

    // ~
    protected function blockTable($line, array $block = null) {
        return $this->__doTable($line, $block, __FUNCTION__, 0);
    }

    // ~
    protected function blockTableContinue($line, array $block) {
        return $this->__doTable($line, $block, __FUNCTION__, 1);
    }

    // ~
    protected function inlineFootnoteMarker($excerpt) {
        if(preg_match('#^\[\^(.+?)\]#', $excerpt['text'], $m)) {
            $name = $m[1];
            if( ! isset($this->DefinitionData['Footnote'][$name])) return;
            $this->DefinitionData['Footnote'][$name]['count']++;
            if( ! isset($this->DefinitionData['Footnote'][$name]['number'])) {
                $this->DefinitionData['Footnote'][$name]['number'] = ++$this->footnoteCount;
            }
            $text = $this->DefinitionData['Footnote'][$name]['number'];
            if(is_callable($this->footnote_link_text)) {
                $text = call_user_func($this->footnote_link_text, $text, $excerpt, $m, $this);
            } else if($this->footnote_link_text) {
                $text = sprintf($this->footnote_link_text, $text);
            }
            $element = array(
                'name' => 'sup',
                'attributes' => array('id' => sprintf($this->footnote_back_link_id, $this->DefinitionData['Footnote'][$name]['count'], $name)),
                'handler' => 'element',
                'text' => array(
                    'name' => 'a',
                    'attributes' => array(
                        'href' => '#' . sprintf($this->footnote_link_id, $name),
                        'class' => $this->footnote_link_class
                    ),
                    'text' => $text
                )
            );
            return array(
                'extent' => strlen($m[0]),
                'element' => $element
            );
        }
    }

    // ~
    private $footnoteCount = 0;

    // ~
    protected function buildFootnoteElement() {
        $element = array(
            'name' => 'div',
            'attributes' => array('class' => $this->footnote_class),
            'handler' => 'elements',
            'text' => array(
                array('name' => 'hr'),
                array(
                    'name' => 'ol',
                    'handler' => 'elements',
                    'text' => array()
                )
            )
        );
        uasort($this->DefinitionData['Footnote'], 'parent::sortFootnotes');
        foreach($this->DefinitionData['Footnote'] as $id => $data) {
            if( ! isset($data['number'])) continue;
            $text = $data['text'];
            $text = parent::text($text);
            $numbers = range(1, $data['count']);
            $markup = "";
            foreach($numbers as $number) {
                $markup .= ' <a href="#' . sprintf($this->footnote_back_link_id, $number, $id) . '" rev="footnote" class="' . $this->footnote_back_link_class . '">' . $this->footnote_back_link_text . '</a>';
            }
            $markup = substr($markup, 1);
            if(substr($text, -4) === '</p>') {
                $markup = '&#160;' . $markup;
                $text = substr_replace($text, $markup . '</p>', -4);
            } else {
                $text .= "\n" . '<p>' . $markup . '</p>';
            }
            $element['text'][1]['text'][] = array(
                'name' => 'li',
                'attributes' => array('id' => sprintf($this->footnote_link_id, $id)),
                'text' => "\n" . $text . "\n"
            );
        }
        return $element;
    }

    // ~
    protected function inlineCode($excerpt) {
        if($data = parent::inlineCode($excerpt)) {
            if( ! $this->code_text) return $data;
            if(is_callable($this->code_text)) {
                $data['element']['text'] = call_user_func($this->code_text, $data['element']['text'], $data, $excerpt, $this);
            } else {
                $data['element']['text'] = sprintf($this->code_text, $data['element']['text']);
            }
        }
        return $data;
    }

    // ~
    private function __doBlockCode($block, $fn) {
        if($data = call_user_func('parent::' . $fn, $block)) {
            if( ! $this->code_block_text) return $data;
            if(is_callable($this->code_block_text)) {
                $data['element']['text']['text'] = call_user_func($this->code_block_text, $data['element']['text']['text'], $data, $block, $this);
            } else {
                $data['element']['text']['text'] = sprintf($this->code_block_text, $data['element']['text']['text']);
            }
        }
        return $data;
    }

    // ~
    protected function blockCodeComplete($block) {
        return $this->__doBlockCode($block, __FUNCTION__);
    }

    // ~
    protected function blockFencedCodeComplete($block) {
        return $this->__doBlockCode($block, __FUNCTION__);
    }

    // Advance parse attributes ...
    protected function parseAttributeData($text) {
        // Allow compact attributes ...
        $text = str_replace(array('#', '.'), array(' #', ' .'), $text);
        if(strpos($text, '="') !== false || strpos($text, '=\'') !== false) {
            $text = preg_replace_callback('#([-\w]+=)(["\'])([^\n]*?)\2#', function($m) {
                $s = str_replace(array(' #', ' .', ' '), array('#', '.', "\n"), $m[3]);
                return $m[1] . $m[2] . $s . $m[2];
            }, $text);
        }
        $attrs = array();
        foreach(explode(' ', $text) as $v) {
            if( ! $v) continue;
            // `{#foo}`
            if($v[0] === '#' && isset($v[1])) {
                $attrs['id'] = substr($v, 1);
            // `{.foo}`
            } else if($v[0] === '.' && isset($v[1])) {
                $attrs['class'][] = substr($v, 1);
            // ~
            } else if(strpos($v, '=') !== false) {
                $vv = explode('=', $v, 2);
                // `{foo=}`
                if($vv[1] === "") {
                    $attrs[$vv[0]] = "";
                // `{foo="bar baz"}`
                // `{foo='bar baz'}`
                } else if($vv[1][0] === '"' && substr($vv[1], -1) === '"' || $vv[1][0] === "'" && substr($vv[1], -1) === "'") {
                    $attrs[$vv[0]] = str_replace("\n", ' ', substr(substr($vv[1], 1), 0, -1));
                // `{foo=bar}`
                } else {
                    $attrs[$vv[0]] = $vv[1];
                }
            // `{foo}`
            } else {
                $attrs[$v] = $v;
            }
        }
        if(isset($attrs['class'])) {
            $attrs['class'] = implode(' ', $attrs['class']);
        }
        return $attrs;
    }

    protected $regexAttribute = '(?:[#.][-\w]+[ ]*|[-\w]+(?:=(?:["\'][^\n]*?["\']|[^\s]+)?)?[ ]*)';

    // Allow empty abbreviations ...
    protected function blockAbbreviation($line) {
        if(preg_match('/^\*\[(.+?)\]:[ ]*$/', $line['text'], $m)) {
            $this->DefinitionData['Abbreviation'][$m[1]] = null;
            return array('hidden' => true);
        }
        return parent::blockAbbreviation($line);
    }

}
