<p>This is a Drupal 8 module which allows site builders to create as many twitter blocks as they like with each having different templates. The key of this module is not to just display the twitter feed of the given account but to pull account information from content type record and display that account's feed. For example, if you have a content type called 'company' with twitter account field, then this module will be the one who displays that specific company's twitter feed. not one global twitter feed like other modules do.</p>
<p>This module is mainly for a educational purpose. I am trying to port this specific need to Drupal 8 and add more features as I go, in the same time learn Drupal 8.</p>
<p>This module is not suitable for any kind of use because it is still in development and I develop when I feel like it.</p>

<p>Current features:
<ol>
<li>Twitter integration;</li>
<li>Basic templating system, which already handles:
<ul>
<li>loading custom templates with their css and js files;</li>
<li>apply template for the block.</li>
</ul></li>
<li>Provides one block with the chosen template.</li>
</ol></p>

<p>Features checklist:
<ol>
<li>Let people create as many blocks as they like.</li>
<li>Let people choose content type and field for the specific block.</li>
</ol>
</p>

<p>This material is open to everyone who wants to improve Drupal 8 skills. At this point of time you can learn the following:
<ol>
<li>Routing - create pages for content or settings forms. It is the replacement of hook_menu in Drupal7;</li>
<li>Local tasks - for creating tabs in page. especially useful for settings page.</li>
<li>Forms - create your forms, discover new Drupal 8 configuration. There will be no variable_set or variable_get anymore.</li>
<li>Blocks - create your own custom blocks in code.</li>
<li>Theming - please, don't write html where module logic resides. Put it in the templates and you will see how.</li>
<li>Twig - new templating engine for Drupal 8. Keep in mind, that twig is compiled, so don't pull your hair out when you can't see your changes. Flushing whole cache is not needed - go to files folder, you will see all compiled twig files in cache folder. Just delete those files and you will see your changes.</li>
</ol></p>
<p>A.B.</p>
