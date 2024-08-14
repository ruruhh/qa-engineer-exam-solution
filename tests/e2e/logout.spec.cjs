const { test, expect } = require('@playwright/test');

test('user can log out', async ({ page }) => {
    await page.goto('/login');
    await page.getByPlaceholder('Email').fill('admin@example.com');
    await page.getByPlaceholder('Password').fill('password');
    await page.getByText('Sign In').click();

    await expect(page).toHaveURL(/product/);

    await page.getByText('Logout').click();
    await expect(page).toHaveURL(/\//);
});

