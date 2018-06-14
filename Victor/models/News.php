<?php
/**
 * Created by PhpStorm.
 * User: ozharko
 * Date: 6/14/18
 * Time: 1:07 PM
 */

//echo ROOT;

class News
{
	/**
	 * Returns single news item with specified id
	 * $param integer $id
	 */

	public static function getNewsItemById($id)
	{
		$id = intval($id);

		if ($id)
		{
			$db = Db::getConnection();

			$result = $db->query('SELECT * FROM pub WHERE id= ' . $id);

//			$result->setFetchMode(PDO::FETCH_NUM);
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$newsItem = $result->fetch();

			return $newsItem;
		}
	}

	/**
	 * Returns an array if news items
	 */
	public static function getNewsList()
	{
		$db = Db::getConnection();

		$newsList = array();

		$qu = 'SELECT id, title, date, short_content '
			. 'FROM pub '
			. 'ORDER BY date DESC '
			. 'LIMIT 10 ';

		$result = $db->prepare($qu);
		$result->execute();
//		print_r($qu);
//		$result = $db->query('SELECT id, title, date, short_content '
//							. 'FROM news '
//							. 'ORDER BY date DESC '
//							. 'LIMIT 10 ');

		$i = 0;
		while ($row = $result->fetch())
		{
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}

		return $newsList;

	}

}