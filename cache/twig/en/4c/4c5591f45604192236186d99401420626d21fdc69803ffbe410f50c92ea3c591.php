<?php

/* layout.html.twig */
class __TwigTemplate_6f35fd5bc373e64d343119349c86c44d7c999b1caca1d2a8e205a7f14978ff57 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'nav_links' => array($this, 'block_nav_links'),
            'master_header' => array($this, 'block_master_header'),
            'page_content' => array($this, 'block_page_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
        echo "\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</title>
    <link href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500,700\" rel=\"stylesheet\">
    <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('add_hash')->getCallable(), array("styles/main.css")), "html", null, true);
        echo "\" rel=\"stylesheet\">
    <script src=\"";
        // line 8
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('add_hash')->getCallable(), array("scripts/main.js")), "html", null, true);
        echo "\"></script>

</head>
<body>
<header class=\"header\">
    <div class=\"content\">
        <div class=\"logo\">
            <a href=\"/";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
        echo "/home.html\" class=\"icon internal\" title=\"Go to home page\">logo</a>
        </div>
        <div class=\"menu\">
            <nav>
                <ul>
                    ";
        // line 20
        $this->displayBlock('nav_links', $context, $blocks);
        // line 22
        echo "                </ul>
            </nav>
        </div>
    </div>
</header>

<div class=\"master-header\">
    ";
        // line 29
        $this->displayBlock('master_header', $context, $blocks);
        // line 31
        echo "</div>

<section class=\"page-content\">
    <ul>
        <li><a href=\"/ru/";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["currentPage"]) ? $context["currentPage"] : null), "html", null, true);
        echo "\">Русский</a></li>
        <li><a href=\"/en/";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["currentPage"]) ? $context["currentPage"] : null), "html", null, true);
        echo "\">English</a></li>
        <li><a href=\"/ro/";
        // line 37
        echo twig_escape_filter($this->env, (isset($context["currentPage"]) ? $context["currentPage"] : null), "html", null, true);
        echo "\">Romana</a></li>
    </ul>

    ";
        // line 40
        $this->displayBlock('page_content', $context, $blocks);
        // line 42
        echo "</section>

</body>
</html>
";
    }

    // line 20
    public function block_nav_links($context, array $blocks = array())
    {
        // line 21
        echo "                    ";
    }

    // line 29
    public function block_master_header($context, array $blocks = array())
    {
        // line 30
        echo "    ";
    }

    // line 40
    public function block_page_content($context, array $blocks = array())
    {
        // line 41
        echo "    ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 41,  115 => 40,  111 => 30,  108 => 29,  104 => 21,  101 => 20,  93 => 42,  91 => 40,  85 => 37,  81 => 36,  77 => 35,  71 => 31,  69 => 29,  60 => 22,  58 => 20,  50 => 15,  40 => 8,  36 => 7,  31 => 5,  25 => 2,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.html.twig", "/var/www/html/layouts/layout.html.twig");
    }
}
