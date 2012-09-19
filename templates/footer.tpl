
		<footer>
			<p>&copy; {$settings.date_start|date_format:'%Y'}{if $smarty.now|date_format:'%Y' > $settings.date_start|date_format:'%Y'} - {$smarty.now|date_format:'%Y'}{/if}, {$settings.copyright}.</p>
		</footer>

    </div><!--/.fluid-container-->

	{include file="`$paths.admin_templates`/cnct.tpl"}
</body>
</html>