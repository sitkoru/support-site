		<div class="well sidebar-nav">
            <ul class="nav nav-list">
			{foreach from=$mainmenu item=rec key=key}
				<li class="nav-header">{$rec.title}
				{if $rec.sub}
					<ul>
					{foreach from=$rec.sub item=rec2}
						<li><a href="{$rec2.url}">{$rec2.title}</a>
						{if $rec2.sub and $rec2.show_subs}
							<ul>
							{foreach from=$rec2.sub item=rec3}
								<li><a href="{$rec3.url}">{$rec3.title}</a>
								{if $rec3.sub and $rec3.show_subs}
									<ul>
									{foreach from=$rec3.sub item=rec4}
										<li><a href="{$rec4.url}">{$rec4.title}</a>
										{if $rec4.sub and $rec4.show_subs}
											<ul>
											{foreach from=$rec4.sub item=rec5}
												<li><a href="{$rec5.url}">{$rec5.title}</a></li>
											{/foreach}
											</ul>
										{/if}
										</li>
									{/foreach}
									</ul>
								{/if}
								</li>
							{/foreach}
							</ul>
						{/if}
						</li>
					{/foreach}
					</ul>
				{/if}
				</li>
			{/foreach}
            </ul>
		</div><!--/.well -->
