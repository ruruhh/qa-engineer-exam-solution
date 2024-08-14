const { test, expect } = require('@playwright/test');

test('user can log in with correct credentials', async ({ page }) => {
    await page.goto('/login');
    await page.getByPlaceholder('Email').fill('admin@example.com');
    await page.getByPlaceholder('Password').fill('password');
    await page.getByText('Sign In').click();

    await expect(page).toHaveURL(/product/);
});

test('user cannot log in without correct credentials', async ({ page }) => {
    await page.goto('/login');
    await page.getByPlaceholder('Email').fill('wrong@email.com');
    await page.getByPlaceholder('Password').fill('password');
    await page.getByText('Sign In').click();

    await expect(page).toHaveURL(/login/);
    expect(page.getByText('These credentials do not match our records.')).toBeTruthy();
});
