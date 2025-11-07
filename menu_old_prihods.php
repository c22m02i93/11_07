<div class="menu_prihods">
<ul id="menu_prihods">

<li class="text_menu"><b>Показывать:</b> </li>
		               <li <? if (empty($blag) && empty($raion)) echo 'class="menu_none"';?>>
               <?
			   if (empty($blag) && empty($raion)) echo '<a>Все</a>';
			   else echo '<a href="old_prihods.php">Все </a>';
				?>
				
        </li>

				<li class="menu_title">
               <a>По благочиниям</a>
			     <ul>  

							<li <? if ($blag == 1) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag == 1) echo '<a>1 благочиние</a>';
			   				else echo '<a href="old_prihods.php?blag=1">1 благочиние</a>';
							?>
							</li>  

							<li <? if ($blag == 2) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag == 2) echo '<a>2 благочиние</a>';
			   				else echo '<a href="old_prihods.php?blag=2">2 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag == 3) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag == 3) echo '<a>3 благочиние</a>';
			   				else echo '<a href="old_prihods.php?blag=3">3 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag == 4) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag == 4) echo '<a>4 благочиние</a>';
			   				else echo '<a href="old_prihods.php?blag=4">4 благочиние</a>';
							?>
							</li>  
							<li <? if ($blag == 5) echo 'class="menu_none"';?>>
               				<?
			   				if ($blag == 5) echo '<a>5 благочиние</a>';
			   				else echo '<a href="old_prihods.php?blag=5">5 благочиние</a>';
							?>
							</li>  
							                      
                </ul>
        </li>
				<li class="menu_title">
               <a>По районам</a>
			     <ul>  

							<li <? if ($raion==Базарносызганский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Базарносызганский) echo '<a>Базарносызганский</a>';
			   				else echo '<a href="old_prihods.php?raion=Базарносызганский">Базарносызганский</a>';
							?>
							</li>  
							<li <? if ($raion==Барышский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Барышский) echo '<a>Барышский</a>';
			   				else echo '<a href="old_prihods.php?raion=Барышский">Барышский</a>';
							?>
							</li>  
							<li <? if ($raion==Инзенский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Инзенский) echo '<a>Инзенский</a>';
			   				else echo '<a href="old_prihods.php?raion=Инзенский">Инзенский</a>';
							?>
							</li>  
							<li <? if ($raion==Николаевский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Николаевский) echo '<a>Николаевский</a>';
			   				else echo '<a href="old_prihods.php?raion=Николаевский">Николаевский</a>';
							?>
							</li>  
							<li <? if ($raion==Павловский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Павловский) echo '<a>Павловский</a>';
			   				else echo '<a href="old_prihods.php?raion=Павловский">Павловский</a>';
							?>
							</li>  
							<li <? if ($raion==Радищевский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Радищевский) echo '<a>Радищевский</a>';
			   				else echo '<a href="old_prihods.php?raion=Радищевский">Радищевский</a>';
							?>
							</li>  
							<li <? if ($raion==Старокулаткинский) echo 'class="menu_none"';?>>
               				<?
			   				if ($raion==Старокулаткинский) echo '<a>Старокулаткинский</a>';
			   				else echo '<a href="old_prihods.php?raion=Старокулаткинский">Старокулаткинский</a>';
							?>
							</li>  

                </ul>
        </li>
</ul>

</div>
