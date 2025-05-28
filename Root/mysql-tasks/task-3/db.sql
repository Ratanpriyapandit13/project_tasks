-- 1. Get users who placed more than 5 orders
SELECT u.id, u.name, u.email, COUNT(o.id) AS total_orders
FROM users u
JOIN orders o ON u.id = o.user_id
GROUP BY u.id, u.name, u.email
HAVING COUNT(o.id) > 5;

--  2. Find users whose average order amount is more than $500
SELECT u.id, u.name, u.email, AVG(o.amount) AS avg_order_amount
FROM users u
JOIN orders o ON u.id = o.user_id
GROUP BY u.id, u.name, u.email
HAVING AVG(o.amount) > 500;


--  3. List users who placed their first order in the last 30 days
SELECT u.id, u.name, u.email
FROM users u
JOIN (
    SELECT user_id, MIN(order_date) AS first_order_date
    FROM orders
    GROUP BY user_id
) first_orders ON u.id = first_orders.user_id
WHERE first_orders.first_order_date >= CURDATE() - INTERVAL 30 DAY;