
<div class="menu_prihods">
<ul id="menu_prihods">
<li class="text_menu"><b>Показывать:</b> </li>

				<li class="menu_title">
               <a  <? if (empty($blag_get) && empty($status_get)) echo 'style="color: red"';?>>Все</a>
			     <ul>  

							<li <? if (empty($blag_get) && empty($alfa) && empty($status_get)) echo 'class="menu_none"';?>>
               				<?
			   				if (empty($blag_get) && empty($alfa) && empty($status_get))  echo '<a>По благочиниям</a>';
			   				else echo '<a href="'.$href.'.php">По благочиниям</a>';
							?>
							</li>  

							<li <? if ($alfa == 1) echo 'class="menu_none"';?>>
               				<?
			   				if ($alfa == 1) echo '<a>По алфавиту</a>';
			   				else echo '<a href="'.$href.'.php?alfa=1">По алфавиту</a>';
							?>
							</li>  
                </ul>
        </li>
		
				<li class="menu_title">
               <a <? if ($blag_get) echo ' style="color: red"';?>>По благочиниям</a>
			     <ul>  

							<li <? if ($blag_get == 1) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag_get == 1) echo '<a>1 благочиние</a>';
			   				else echo '<a href="'.$href.'.php?blag_get=1">1 благочиние</a>';
							?>
							</li>  

							<li <? if ($blag_get == 2) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag_get == 2) echo '<a>2 благочиние</a>';
			   				else echo '<a href="'.$href.'.php?blag_get=2">2 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag_get == 3) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag_get == 3) echo '<a>3 благочиние</a>';
			   				else echo '<a href="'.$href.'.php?blag_get=3">3 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag_get == 4) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag_get == 4) echo '<a>4 благочиние</a>';
			   				else echo '<a href="'.$href.'.php?blag_get=4">4 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag_get == 5) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag_get == 5) echo '<a>5 благочиние</a>';
			   				else echo '<a href="'.$href.'.php?blag_get=5">5 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag_get == 'mon') echo 'class="menu_none"';?>>
               				<?
			   				if ($blag_get == 'mon') echo '<a>Монастырь</a>';
			   				else echo '<a href="'.$href.'.php?blag_get=mon">Монастырь</a>';
							?>
							</li>  
           </ul>
     </li>
	 <?php if ($href == 'my_klir') {
		 ?>
				<li class="menu_title">
               <a <? if ($status_get) echo ' style="color: red"';?>>По статусам</a>
			     <ul>  

							<li <? if ($status_get == 'штатный') echo 'class="menu_none"';?>>
               				<?
			   				if ($status_get == 'штатный') echo '<a>Штатные</a>';
			   				else echo '<a href="'.$href.'.php?status_get=штатный">Штатные</a>';
							?>
							</li>  

							<li <? if ($status_get == 'на покое') echo 'class="menu_none"';?>>
               				<?
			   				if ($status_get == 'на покое') echo '<a>На покое</a>';
			   				else echo '<a href="'.$href.'.php?status_get=на покое">На покое</a>';
							?>
							</li>  
							<li <? if ($status_get == 'заштатный') echo 'class="menu_none"';?>>
               				<?
			   				if ($status_get == 'заштатный') echo '<a>Заштатные</a>';
			   				else echo '<a href="'.$href.'.php?status_get=заштатный">Заштатные</a>';
							?>
							</li>  
							<li <? if ($status_get == 'запрещенный') echo 'class="menu_none"';?>>
               				<?
			   				if ($status_get == 'запрещенный') echo '<a>Запрещенные</a>';
			   				else echo '<a href="'.$href.'.php?status_get=запрещенный">Запрещенные</a>';
							?>
							</li>  
							<li <? if ($status_get == 'архивный') echo 'class="menu_none"';?>>
               				<?
			   				if ($status_get == 'архивный') echo '<a>Архивные</a>';
			   				else echo '<a href="'.$href.'.php?status_get=архивный">Архивные</a>';
							?>
							</li>  
						</ul>
     </li>

	 <?php } ?>
	 </ul>

</div>
