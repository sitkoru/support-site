
			<!-- Footer -->
			<div class="row">
				<footer class="body-footer span8">
					<div class="add">
						<h2><a href="#">Лучший тариф</a> от Билайн</h2>
						<div class="text">Информация о тарифах и услугах для частных и корпоративных клиентов.</div>
					</div>
					<div class="banners">
						{$settings.counter}
						{literal}
						<div class="slidetop" onclick="$('body').animate({scrollTop: 0})">&and;</div>
						{/literal}
					</div>
					<div class="copyrights">
						<h3>
							&copy;&nbsp;<nobr>2004-{$smarty.now|date_format:'%Y'},</nobr> {$settings.copyright}
						</h3>
						{$settings.copyleft}

					</div>
				</footer>
			</div>
			<!-- Footer -->

		</div>
		<!-- /Главная обертка -->
		
	{include file="`$paths.admin_templates`/cnct.tpl"}
</body>
</html>