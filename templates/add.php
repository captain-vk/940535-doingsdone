



      <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="/add.php" method="post" enctype="multipart/form-data">
          <div class="form__row">
		  <p class="form__message">
		  <?php if ($arr_alarms['Название']==false) {echo "Введите название задачи";}?>
		  </p>
				<?php if ($arr_alarms['Название']==false) {echo "Заполните поле";}?>

            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input<?php if ($arr_alarms['Название']==false) {echo " form__input--error";}?>" type="text" name="name" id="name" value="<?php $_POST['name_task']; ?>" placeholder="Введите название">
          </div>

          <div class="form__row">
		  
		  <p class="form__message">
		  <?php if ($arr_alarms['Проект']==false) {echo "Проект не существует!";}?>
		  </p>
            <label class="form__label" for="project">Проект</label>
            <select class="form__input form__input--select<?php if ($arr_alarms['Проект']==false) {echo " form__input--error";}?>" name="project" id="project">
			<?php for ($i = 0; $i < count($arr); $i++):?>
              <option value="<?php echo $arr[$i]['id'];?>"><?php echo $arr[$i]['name']; ?> </option>
			  <?php endfor; ?>
            </select>
          </div>

          <div class="form__row">
		  	<p class="form__message">
		  <?php if ($arr_alarms['Дата выполнения']==false) {echo "Некорректная дата";}?>
		  </p>
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input<?php if ($arr_alarms['Дата выполнения']==false) {echo " form__input--error";}?> form__input--date" type="date" name="date" id="date" value="<?php $_POST['date_exec']; ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
          </div>

          <div class="form__row">
            <label class="form__label" for="preview">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="preview" id="preview" value="">

              <label class="button button--transparent" for="preview">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>
		  <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
      </main>
