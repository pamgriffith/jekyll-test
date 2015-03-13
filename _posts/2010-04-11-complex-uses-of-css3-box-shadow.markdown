---
layout: post
status: publish
published: true
title: Complex uses of css3 box-shadow
author:
  display_name: Pam Griffith
  login: Pam
  email: pam@pamgriffith.net
  url: http://www.pamgriffith.net
author_login: Pam
author_email: pam@pamgriffith.net
author_url: http://www.pamgriffith.net
wordpress_id: 273
wordpress_url: http://www.pamgriffith.net/?p=273
date: !binary |-
  MjAxMC0wNC0xMSAwMDoxODo1MCAtMDQwMA==
date_gmt: !binary |-
  MjAxMC0wNC0xMSAwNzoxODo1MCAtMDQwMA==
categories:
- Code
- Visual Design
tags:
- CSS
comments:
- id: 229
  author: Tweets that mention Complex uses of css3 box-shadow | pamgriffith.net --
    Topsy.com
  author_email: ''
  author_url: http://topsy.com/trackback?utm_source=pingback&amp;utm_campaign=L1&amp;url=http://www.pamgriffith.net/blog/complex-uses-of-css3-box-shadow
  date: !binary |-
    MjAxMC0wNC0yMyAwNjowMTowMSAtMDQwMA==
  date_gmt: !binary |-
    MjAxMC0wNC0yMyAxMzowMTowMSAtMDQwMA==
  content: ! '[...] This post was mentioned on Twitter by Gilles Wittenberg. Gilles
    Wittenberg said: Pam Griffith: Complex uses of css3 box-shadow. http://www.pamgriffith.net/blog/complex-uses-of-css3-box-shadow
    [...]'
- id: 3942
  author: CSS Chops &raquo; Complex uses of CSS3 box-shadow
  author_email: ''
  author_url: http://csschops.com/complex-uses-of-css3-box-shadow/
  date: !binary |-
    MjAxMS0wNy0wOCAwODoxNTowOCAtMDQwMA==
  date_gmt: !binary |-
    MjAxMS0wNy0wOCAxNToxNTowOCAtMDQwMA==
  content: ! '[...] CSSComplex uses of CSS3&nbsp;box-shadow Posted by: The Selector
    on Jul 8, 2011 | No CommentsSource: http://www.pamgriffith.net/blog/complex-uses-of-css3-box-shadowClever
    solution for CSS box-shadow applied to navigational tabs.Leave a Reply Name (required)
    Email [...]'
---
<p>Sort of as a follow-up to the previous post on html5 and css3, I've been applying css3 to various situations to see how it does.  I've run across a couple examples where box-shadow in particular doesn't quite manage what I need it to do, this post will present the workarounds I found.</p>
<p>I'll be referring to the use of varied shadow size and intensity to create a consistent sense of depth.  I highly recommend <a href="http://desktoppub.about.com/od/creategraphics/ss/dropshadows_4.htm">this summary</a> of the subject, which is actually what got me thinking about the second case here.</p>
<h5>Fixed menus and tabs</h5>
<p>What happens when you have a header (or other element) with a box shadow and tabs or a drop-down menu suspended from it?  Ideally, those items would have matching shadows to maintain the illusion of depth.  You may want something like the following image:</p>
<p>[caption id="attachment_299" align="alignnone" width="227" caption="A drop-down menu below a header with a continuous shadow around the outside"]<a href="http://www.pamgriffith.net/wp-content/2010/04/menushadow.gif"><img class="size-full wp-image-299" title="menushadow" src="http://www.pamgriffith.net/wp-content/2010/04/menushadow.gif" alt="" width="227" height="194" /></a>[/caption]</p>
<p>Unfortunately, if you just have a shadow on each of the menus and the header you're more likely to end up with something like one of these:</p>
<p>[caption id="attachment_301" align="alignnone" width="227" caption="Two menus with inconsistent shadows"]<a href="http://www.pamgriffith.net/wp-content/2010/04/menushadow_inconsistent.gif"><img class="size-full wp-image-301" title="menushadow_inconsistent" src="http://www.pamgriffith.net/wp-content/2010/04/menushadow_inconsistent.gif" alt="" width="227" height="194" /></a>[/caption]</p>
<p>The menu on the left is inside the header element and positioned so the top of the menu is at the bottom of the header.  The menu's shadow is cast on top of the header, which is probably not what anyone wants.</p>
<p>The problem with the one on the right is a little more subtle, and a lot of web designs do it all the time.  But it may not feel quite right, because <strong>shadow is an indication of depth</strong>.  The shadow cast on the menu is the same as that cast on the page, indicating that they are at the same depth, but the menu casts a shadow too, indicating that it is <em>not</em> at the same level as the page below the header.  It would actually be more consistent not to include a shadow from the right menu at all.</p>
<p>The left menu also has that problem: the header and menu cast the same shadow, indicating that they are at the same depth, but the shadow from the menu onto the header says that they are not.</p>
<p>One solution to this is to use something like the first menu but to <strong>cut off the shadow at the top</strong> that it casts onto the header to put the menu and the header at the same depth.  Overflow:hidden will do nicely for that.  (You might want to have your menu looking like it's layered between the header and the body, I'll get to that later.)</p>
<p>We'll have the following html:</p>
<pre><code class="html">&lt;header&gt;
    &lt;nav&gt;
        &lt;ul&gt;
            &lt;li&gt;oranges&lt;/li&gt;
            &lt;li&gt;strawberries&lt;/li&gt;
            &lt;li&gt;grapes&lt;/li&gt;
            &lt;li&gt;lemons&lt;/li&gt;
        &lt;/ul&gt;
        &lt;ul&gt;
            &lt;li&gt;lettuce&lt;/li&gt;
            &lt;li&gt;cabbage&lt;/li&gt;
            &lt;li&gt;spinach&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/nav&gt;
&lt;/header&gt;</code></pre>
<p>There are two unordered lists nested inside a nav element.  (This example is html5, but of course you can use divs with classes too.)  The nav element is what we'll use to trim off the tops of the menus.  The key css is here:</p>
<pre><code class="css">header { display: block; width: 100%; height: 100px; background-color: #FFC; box-shadow: 0 0 10px rgba(0,0,0,.5); }
nav { display: block; position: absolute; top: 100px; left: 0; width: 100%; overflow: hidden; padding-bottom: 10px; }
nav ul { margin: -10px 15px 0 15px; padding: 10px 0 0 0; float: left; background-color: #FFC; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,.5); }
nav ul li { margin: 0; padding: 5px 10px; list-style: none; }</code></pre>
<p>The nav is absolutely positioned to the bottom of the header with overflow:hidden.  The boxes for the unordered lists will start at the top of the nav, but the shadow will extend above the top edge of the nav and be cut off.  Here the lists also have a negative margin to cut off the top rounded corners instead of  using extra "border-top-radius" etc. styles, but that isn't really necessary.</p>
<p style="text-align: center;"><a class="demo-popup-link demo-popup-id-css3 download_button" rel="demo" href="/demo/css3/menushadow.html">demo page</a></p>
<h5>Drop-down menus</h5>
<p>That all works great if you just want a static tab extending from your header, <strong>but if you want real interactive drop-down menus it gets a little more complicated</strong>.  Say we have the following:</p>
<pre><code class="html">&lt;header&gt;
    &lt;nav&gt;
        &lt;ul&gt;
            &lt;li&gt;fruit
                &lt;ul&gt;
                    &lt;li&gt;oranges&lt;/li&gt;
                    &lt;li&gt;strawberries&lt;/li&gt;
                    &lt;li&gt;grapes&lt;/li&gt;
                    &lt;li&gt;lemons&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/li&gt;
            &lt;li&gt;leafy greens
                &lt;ul&gt;
                    &lt;li&gt;lettuce&lt;/li&gt;
                    &lt;li&gt;cabbage&lt;/li&gt;
                    &lt;li&gt;spinach&lt;/li&gt;
                &lt;/ul&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/nav&gt;
&lt;/header&gt;</code></pre>
<p>Each of the drop-down menus is now inside another list element that contains the header for that menu.  The menu headers should appear inside the header, and hovering or clicking should cause the menu to appear.</p>
<p>We can't just use the nav element to cut off the top anymore because that will clip the header too.  I keep saying how awesome css is in letting us take out extra elements we've been using for rounded corners and shadows, but we're going to have to put one back in for this (<em>d'oh</em>).  Lets wrap each of the drop-down menus in another nav (or div, or whatever you like--semantics people can argue about that one, nav seemed appropriate to me):</p>
<pre><code class="html">&lt;header&gt;
    &lt;nav&gt;
        &lt;ul&gt;
            &lt;li&gt;fruit
                &lt;nav&gt;
                    &lt;ul&gt;
                        &lt;li&gt;oranges&lt;/li&gt;
                        &lt;li&gt;strawberries&lt;/li&gt;
                        &lt;li&gt;grapes&lt;/li&gt;
                        &lt;li&gt;lemons&lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/nav&gt;
            &lt;/li&gt;
            &lt;li&gt;leafy greens
                &lt;nav&gt;
                    &lt;ul&gt;
                        &lt;li&gt;lettuce&lt;/li&gt;
                        &lt;li&gt;cabbage&lt;/li&gt;
                        &lt;li&gt;spinach&lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/nav&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/nav&gt;
&lt;/header&gt;</code></pre>
<p>Now it will be the inner nav only that gets positioned at the bottom of the header with overflow:hidden:</p>
<pre><code class="css">nav nav { position: absolute; top: 30px; left: 0; padding: 0 20px 10px 20px; overflow: hidden; }
nav ul ul { display: none; background-color: #FFC; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,.5); border: 1px solid #979700; margin: -10px -10px 0 -10px; padding-top: 10px; }
nav ul li:hover ul { display: block; }
nav ul ul li { float: none; padding: 5px 10px; }</code></pre>
<p>Notice the extra margins and paddings in there to make sure the list is lined up correctly and the nav element isn't cutting off any other sides of the shadow.</p>
<p style="text-align: center;"><a class="demo-popup-link demo-popup-id-css3 download_button" rel="demo" href="/demo/css3/menushadow2.html">demo page</a></p>
<h5>Multiple shadow depths</h5>
<p>What if you want to have two elements overlapping at different distances from the background (i.e., something with a longer, lighter shadow on top of something with a shorter, darker one).  The shadow of the upper element will need to be shorter where it overlaps the second element than where it is over the background.</p>
<p>You can use this technique on the drop-down menus mentioned above tomake them look like they're lower than the header they're dropping from, but lets start with something simpler first.  Let's say you have a header with a shadow and a sidebar that should look like it's half way between the header and the background page.  You may want to end up with something like this:</p>
<p>[caption id="attachment_276" align="alignnone" width="424" caption="Shadows of varying perceived depths"]<a href="http://www.pamgriffith.net/wp-content/2010/04/shadowdepth.gif"><img class="size-full wp-image-276" title="shadowdepth" src="http://www.pamgriffith.net/wp-content/2010/04/shadowdepth.gif" alt="" width="424" height="287" /></a>[/caption]</p>
<p>I've made the header shadow spread 20px and the shadows on top of and cast from the sidebar 10px each to add up to 20.  You could also make it 5 and 15, or some other ratio you like.  I've also made them slightly darker, but I can't think of a formula to use for that.</p>
<p>If you just have the header cast the shadow and the sidebar cast a separate shadow it will be a uniform 20px all the way across.  What we want is two separate shadows under the header in addition to the one cast by the sidebar.  Unfortunately, we're going to have to add extra elements to get that.</p>
<p>What we need is one shadow to go all the way across at the bottom of the header underneath the sidebar and another above the sidebar but below the real header so it's possible to click through to the logo or whatever else is in there.  That means something like this:</p>
<pre><code class="html">&lt;div class="fakeshadow"&gt;&lt;/div&gt;
&lt;header&gt;&lt;/header&gt;
&lt;nav&gt;
    &lt;div class="fakeshadow"&gt;&lt;/div&gt;
&lt;/nav&gt;</code></pre>
<p>There are two extra elements there, one just in the body and one inside the nav element that's going to be the sidebar.</p>
<p>The nav and the "fakeshadow" element inside it will have the 10px shadow.  The "fakeshadow" div above the header will go under everything and have the 20px shadow, which the nav will cover.  Here's the css:</p>
<pre><code class="css">header { display: block; position: relative; z-index: 2; width: 100%; height: 100px; background-color: #FFC; }
.fakeshadow { position: absolute; top: 0; left: 0; z-index: 0; width: 100%; height: 100px; box-shadow: 0 0 20px rgba(0,0,0,.5); }
nav { position: absolute; top: 0; left: 0; z-index: 1; width: 200px; height: 100%; background-color: #3CF; box-shadow: 0 0 10px rgba(0,0,0,.7); }
nav .fakeshadow { box-shadow: 0 0 10px rgba(0,0,0,.7); }</code></pre>
<p style="text-align: center;"><a class="demo-popup-link demo-popup-id-css3 download_button" rel="demo" href="/demo/css3/sidebarshadow.html">demo page</a></p>
<h5>Combining everything: drop-down menus with multiple shadow depths</h5>
<p>If we add some of those "fakeshadow" elements to the drop down menus and adjust the menu shadow, we can get something like this:</p>
<p>[caption id="attachment_303" align="alignnone" width="227" caption="Drop-down menus with multiple shadow levels so menus look like they&#39;re closer to the background"]<a href="http://www.pamgriffith.net/wp-content/2010/04/menushadow_multidepth.gif"><img class="size-full wp-image-303" title="menushadow_multidepth" src="http://www.pamgriffith.net/wp-content/2010/04/menushadow_multidepth.gif" alt="" width="227" height="194" /></a>[/caption]</p>
<p>The fakeshadow element is added to the drop-down list, so the html looks like this:</p>
<pre><code class="html">&lt;header&gt;
    &lt;nav&gt;
        &lt;ul&gt;
            &lt;li&gt;fruit
                &lt;nav&gt;
                    &lt;ul&gt;
                        &lt;li class="fakeshadow"&gt;&lt;/li&gt;
                        &lt;li&gt;oranges&lt;/li&gt;
                        &lt;li&gt;strawberries&lt;/li&gt;
                        &lt;li&gt;grapes&lt;/li&gt;
                        &lt;li&gt;lemons&lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/nav&gt;
            &lt;/li&gt;
            &lt;li&gt;leafy greens
                &lt;nav&gt;
                    &lt;ul&gt;
                        &lt;li class="fakeshadow"&gt;&lt;/li&gt;
                        &lt;li&gt;lettuce&lt;/li&gt;
                        &lt;li&gt;cabbage&lt;/li&gt;
                        &lt;li&gt;spinach&lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/nav&gt;
            &lt;/li&gt;
        &lt;/ul&gt;
    &lt;/nav&gt;
&lt;/header&gt;</code></pre>
<p>The fake shadow has a box shadow of 4px and the lists now have a shadow of only 6, so the modified css looks like this:</p>
<pre><code class="css">header { display: block; position: relative; width: 100%; height: 100px; background-color: #FFC; box-shadow: 0 0 10px rgba(0,0,0,.5); }

nav { position: absolute; top: 70px; left: 0; }
nav ul, nav li { margin: 0; padding: 0; }
nav ul li { list-style: none; float: left; padding: 5px 20px; position: relative; }

nav nav { position: absolute; top: 30px; left: 0; padding: 0 20px 10px 20px; overflow: hidden; }
nav ul ul { display: none; background-color: #F5F5BA; border-radius: 10px; box-shadow: 0 0 6px rgba(0,0,0,.5); margin: -10px -10px 0 -10px; padding-top: 10px; }
nav ul li:hover ul { display: block; }
nav ul ul li { float: none; padding: 5px 10px; }
nav ul ul li.fakeshadow { padding:0; height:1px; left:0; margin-top:-2px; box-shadow:0 0 4px rgba(0, 0, 0, 1); }</code></pre>
<p>The background color was also adjusted a little bit to bring out the effect.</p>
<p style="text-align: center;"><a class="demo-popup-link demo-popup-id-css3 download_button" rel="demo" href="/demo/css3/menushadow3.html">demo page</a></p>
<h5>Bonus: Animated tabs</h5>
<p><em>Added 3/15/10 because I can't seem to get the idea out of my head</em></p>
<p>In this example, the tabs move when you hover over them but the shadow remains stationary.  It also demonstrates the use of :before (or :after) instead of using a completely separate element in the html.</p>
<p>[caption id="attachment_314" align="alignnone" width="328" caption="Tabs with shadows and hover states"]<a href="http://www.pamgriffith.net/wp-content/2010/04/hovertabs.png"><img class="size-full wp-image-314" title="hovertabs" src="http://www.pamgriffith.net/wp-content/2010/04/hovertabs.png" alt="" width="328" height="108" /></a>[/caption]</p>
<p>The tabs are each li elements with a style similar to that applied to the menu ul above:</p>
<pre><code class="html">&lt;header&gt;
    &lt;nav&gt;
        &lt;ul&gt;
            &lt;li&gt;oranges&lt;/li&gt;
            &lt;li&gt;strawberries&lt;/li&gt;
            &lt;li&gt;grapes&lt;/li&gt;
            &lt;li&gt;lemons&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/nav&gt;
&lt;/header&gt;</code></pre>
<p>There are no fake elements this time--we can also add those fake shadows with :before or :after pseudo-elements.  Here's the css:</p>
<pre><code class="css">nav ul { margin: 0; padding: 0; list-style: none; }
nav ul li { margin: -10px 5px 0 5px; padding: 10px 5px 5px; float: left; background-color: #F5F5BA; border-radius: 10px; box-shadow: 0 0 6px rgba(0,0,0,.5); position: relative; cursor: pointer; }
nav ul li:before { content: ' '; height:1px; width: 100%; position: absolute; left: 0; top: 9px; box-shadow:0 0 4px rgba(0, 0, 0, 1); }
nav ul li:hover { padding-top: 15px; background-color: #FDEBB3; }</code></pre>
<p style="text-align: center;"><a rel="demo" class="demo-popup-link demo-popup-id-css3 download_button" href="/demo/css3/menushadow4.html">demo page</a></p>
<p>[demo-popup id="css3" width="500" height="300" title="CSS Shadows"  interactive="true"]</p>
