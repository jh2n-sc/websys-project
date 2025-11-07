<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">©2025 KABALAYAN. ALL RIGHTS RESERVED</div>
        <div class="footer-center">
            Made by <span class="saentax">Saentax</span>
        </div>
        <div class="footer-right">
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>
<style>
/* Footer */
.footer {
    background-color: var(--surface-color);
    padding: 20px 0;
    position: relative;
    margin-top: 60px;
    border-top: 1px solid var(--border-color);
    color: var(--text-color);
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1180px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
    box-sizing: border-box;
    flex-wrap: wrap;
    gap: 16px;
}

.footer-left {
    font-size: 12px;
    margin: 0 12px;
    order: 1;
    flex: 1;
    min-width: 200px;
}

.footer-center {
    font-size: 14px;
    order: 2;
    margin: 0 12px;
    text-align: center;
}

.saentax {
    color: var(--text-color);
    font-weight: 600;
    margin-left: 4px;
    transition: all 0.3s ease;
}

/* Dark mode styles */
[data-theme="dark"] .saentax {
    text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
}

[data-theme="dark"] .saentax:hover {
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
}

.footer-right {
    display: flex;
    gap: 8px;
    margin: 0 12px;
    order: 3;
    flex: 1;
    justify-content: flex-end;
}

.footer-right a {
    color: var(--text-color);
    text-decoration: none;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    opacity: 0.8;
    font-size: 16px;
    border-radius: 50%;
    background-color: var(--surface-color);
}

.footer-right a:hover {
    transform: translateY(-2px) scale(1.1);
    opacity: 1;
    color: var(--accent-color);
    background-color: var(--accent-color-10);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }
    
    .footer-left,
    .footer-center,
    .footer-right {
        margin: 4px 0;
        order: 0;
        width: 100%;
        justify-content: center;
    }
    
    .footer-right {
        margin-top: 12px;
    }
}
</style>