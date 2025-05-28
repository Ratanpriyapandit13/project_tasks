SELECT customer_id, SUM(amount) AS total_sales
FROM sales
GROUP BY customer_id;



SELECT customer_id, SUM(amount) AS total_sales
FROM sales
GROUP BY customer_id
ORDER BY total_sales DESC
LIMIT 5;


SELECT COUNT(*) AS sales_last_7_days
FROM sales
WHERE sale_date >= CURDATE() - INTERVAL 7 DAY;


SELECT c.id, c.name
FROM customers c
LEFT JOIN sales s 
  ON c.id = s.customer_id AND YEAR(s.sale_date) = 2024
WHERE s.id IS NULL;
