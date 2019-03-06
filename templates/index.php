 <main class="content__main">
     <h2 class="content__main-heading">Список задач</h2>
        <form class="search-form" action="index.php" method="post">
            <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">
            <input class="search-form__submit" type="submit" name="" value="Искать">
        </form>
     <div class="tasks-controls">
					<nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item <?php if (!isset($_GET['tasks_today']) && (!isset($_GET['tasks_tomorrow'])) && (!isset($_GET['tasks_old']))) echo 'tasks-switch__item--active';?>">Все задачи</a>
                        <a href="/index.php?tasks_today" class="tasks-switch__item <?php if (isset($_GET['tasks_today'])) echo 'tasks-switch__item--active'?>">Повестка дня</a> 
                        <a href="/index.php?tasks_tomorrow" class="tasks-switch__item <?php if (isset($_GET['tasks_tomorrow'])) echo 'tasks-switch__item--active';?>">Завтра</a>
                        <a href="/index.php?tasks_old" class="tasks-switch__item <?php if (isset($_GET['tasks_old'])) echo 'tasks-switch__item--active';?>">Просроченные</a>
                    </nav>
         <label class="checkbox">
                        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox"
			<?php if ($show_complete_tasks == true) {echo 'checked'; }?> >
             <span class="checkbox__text">Показывать выполненные</span>
         </label>
      </div>
                <table class="tasks">
						<?php foreach($arr2 as $key => $item):?>
						<?if ($item['Выполнен']=='Да' and $show_complete_tasks == false) { continue; }?>
                    <tr class="tasks__item task  <? if ($item['Выполнен']=='Да'){echo 'task--completed';}?>"> 
                        <td class="task__select">						
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" <?php if ($item['status']=='1'){echo 'checked';} ?> value="<?= $item['id'] ?>">
                                <span class="checkbox__text"><?=htmlspecialchars($item['name']);?></span>
                            </label>
                        </td>
                        <td class="task__file">						
                            <a class="download-link" href="<?=$item['file_link'];?>">Home.psd</a>
                        </td>
                        <td class="task__date"><?=date('d-m-Y', strtotime($item['execution_date']));?></td>
						<? endforeach; ?>
                    </tr>
				 <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->								
                </table>
</main>